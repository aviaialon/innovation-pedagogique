<?php
/**
 * Interface for database driven shared ORM object
 * Requires PHP 5 >= 5.3.0
 *
 * @package    Core
 * @subpackage Interfaces
 * @file       Core/Interfaces/HybernateInterface.php
 * @desc       Used interface for ORM implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */

namespace Core\Interfaces;

/**
 * Interface for database driven shared ORM object
 *
 * @package    Core
 * @subpackage Interfaces
 * @file       Core/Interfaces/HybernateInterface.php
 * @desc       Used interface for ORM implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */
abstract class HybernateInterface
    extends \Core\Interfaces\Base\ObjectBaseInterface
    implements \Core\Interfaces\Base\HybernateBaseInterface  {

    /**
     * Data Access Interface
     *
     * @access protected
     * @var    \Core\Database\DriverInterface
     */
    protected $_dataAccessInterface;

    /**
     * Data Object interface type (table name)
     *
     * @access protected
     * @var    string
     */
    protected $_objectInterfaceType;

    /**
     * Class registry Id
     *
     * @access protected
     * @var    string
     */
    protected $intClassRegistryId;

    /**
     * The identity binding so it can be pre processed by onBeforeGetInstance
     *
     * @access protected
     * @var    mixed
     */
    protected static $_identityBinding;

    /**
     * gets a pointer to the instance registry for instantiation
     *
     * @access public
     * @throws \Exception
     * @return \Core\Interfaces\HybernateInterface
     */
    protected static final function _getInstanceRegistry()
    {
        $instanceNamespace                       = get_called_class();
        $instanceRegistry                        = new $instanceNamespace();
        $interfaceArray                          = explode('\\', $instanceNamespace);
        $instanceRegistry->_objectInterfaceType  = strtolower(end($interfaceArray));

        return $instanceRegistry;
    }

    /**
     * Class contructor
     *
     * @return
     */
    public function __construct()
    {
        $instanceNamespace           = get_called_class();
        $interfaceArray              = explode('\\', $instanceNamespace);
        $this->_objectInterfaceType  = end($interfaceArray);
        $this->_dataAccessInterface  = \Core\Database\Driver\Pdo::getInstance();

        $this->_dataAccessInterface->connect();
    }

    /**
     * Lazy load Instantiation method for shared object. Will not query unless is saved
     *
     * @access public
     * @param  mixed $identifier (Optional) This is the identifier used to load the object (id | array(column=>value))
     * @throws \Exception
     * @return \Core\Interfaces\HybernateInterface
     */
    public static function lazyLoad($identifier = null)
    {
        $instanceRegistry = self::_getInstanceRegistry();
        $instanceRegistry->_beforeCallback(__FUNCTION__, array($identifier));
        $instanceRegistry->setId(0);

        if (true === is_numeric($identifier)) {
            // Load the object by ID
            $identityBinding = array('id' => (int) $identifier);
        } else if (true === is_array($identifier) && false === empty($identifier)) {
            // Load by key/value pairs
            $identityBinding = $identifier;
        }

        $instanceRegistry->_dataRegistry = $identityBinding;
        $instanceRegistry->_changedData  = array();

        $instanceRegistry->_callback(__FUNCTION__, array($identifier));

        return $instanceRegistry;
    }

    /**
     * Instantiation method for shared object
     *
     * @access public
     * @param  mixed $identifier (Optional) This is the identifier used to load the object (id | array(column=>value))
     * @throws \Exception
     * @return \Core\Interfaces\HybernateInterface
     */
    public static function getInstance($identifier = null)
    {
        $instanceRegistry = self::_getInstanceRegistry();
		$instanceRegistry::$_identityBinding = false;
		
        $instanceRegistry->_beforeCallback(__FUNCTION__, array($identifier));
        $instanceRegistry->setId(0);

        // Small hack to allow onBeforeGetInstance to override the identifier
        if (empty($instanceRegistry::$_identityBinding) === false) {
            $identifier = $instanceRegistry::$_identityBinding;
			$instanceRegistry::$_identityBinding = false;
        }
		
        if (true === is_numeric($identifier)) {
            // Load the object by ID
            $identityBinding = array('id' => (int) $identifier);
        } else if (true === is_array($identifier) && false === empty($identifier)) {
            // Load by key/value pairs
            $identityBinding = $identifier;
        }

        if (false === empty($identityBinding)) {
            $dataCollection = $instanceRegistry->_dataAccessInterface->findByBinding($instanceRegistry->_objectInterfaceType, $identityBinding, array(), 1);

            if (false === empty($dataCollection)) {
                $instanceRegistry->_dataRegistry = array_change_key_case(array_shift($dataCollection), CASE_LOWER);
                $instanceRegistry->_changedData  = array();
            }
        }

        $instanceRegistry->_callback(__FUNCTION__, array($identifier));

        return $instanceRegistry;
    }

    /**
     * Multi Instantiator static method
     *
     * @access public
     * @param  array $identifiers  (Optional) Key/Value identifier pairs
     * @param  bool  $fetchAsArray (Optional) Return the data as array
     * @param  array $sqlParams    (Optional) Sql parameters
     * @return array of \Core\Interfaces\Base\Interfaces_Base_HybernateBaseInterface
     */
    public static function getMultiInstance(array $identifiers = array(), $fetchAsArray = false, array $sqlParams = array())
    {
        $instanceRegistry = self::_getInstanceRegistry();
        $arguments        = func_get_args();
        $instanceRegistry->_beforeCallback(__FUNCTION__, $arguments);

        if (true === $fetchAsArray) {
            $instanceRegistry->_dataAccessInterface->setFetchType(\PDO::FETCH_ASSOC);
        } else {
            $instanceRegistry->_dataAccessInterface->setFetchType(\PDO::FETCH_CLASS, get_called_class());
        }

        $dataCollection = $instanceRegistry->_dataAccessInterface->findByBinding($instanceRegistry->_objectInterfaceType, $identifiers, $sqlParams);

        $instanceRegistry->_callback(__FUNCTION__, $arguments);

        return $dataCollection;
    }

    /**
     * This method saves the object
     *
     * @param  bool  $forceNewRecord (Optional) Force the save as a new record
     * @return boolean
     */
    public function save($forceNewRecord = false)
    {
        $arguments  = func_get_args();
        $this->_beforeCallback(__FUNCTION__, $arguments);
        if (false === empty($this->_changedData)) {
            if (true === array_key_exists('id', $this->_changedData) && ((int) $this->_changedData['id'] === 0)) {
                unset ($this->_changedData['id']);
            }

            $this->setId($this->_dataAccessInterface->updateRecord(strtolower($this->_objectInterfaceType), $this->_changedData, $this->getId(), $forceNewRecord));
            $this->_changedData = null;
        }

        $this->_callback(__FUNCTION__, $arguments);

        return ((bool) $this->_dataAccessInterface->affectedRows());
    }

    /**
     * This method deletes the object
     *
     * @return boolean
     */
    public function delete()
    {
        $arguments  = func_get_args();
        $this->_beforeCallback(__FUNCTION__, $arguments);

        if (false === empty($this->_dataRegistry['id'])) {
            $this->_dataAccessInterface->deleteRecord(strtolower($this->_objectInterfaceType), array('id' => (int) $this->_dataRegistry['id']));
        }

        $this->setId(0);
        $this->_dataRegistry = null;
        $this->_changedData  = null;

        $this->_callback(__FUNCTION__, $arguments);

        return ((bool) $this->_dataAccessInterface->affectedRows());
    }

    /**
     * This method returns the class registry ID
     *
     * @access public
     * @param  none
     * @return integer
     */
    public function getClassRegistryId()
    {
        $classNamespace = get_class($this);

        if (($this->intClassRegistryId <= 0) && (empty($classNamespace) === false)) {
            $classRegistry = \Core\Hybernate\ClassRegistry\Class_Registry::getInstance(array(
                'className' => $classNamespace
            ));

            if (false === ((bool) $classRegistry->getId()))
            {
                $classRegistry->setClassName($classNamespace);
                $classRegistry->setDescription('Auto Generated Class Registry Key [' . date('Y-m-d H:i:s', time()) . ']');
                $classRegistry->save();
            }

            $this->intClassRegistryId = (int) $classRegistry->getid();
        }

        return ((int) $this->intClassRegistryId);
    }

    /**
     * This method returns an object view
     *
     * @param:    $arrView [Array]             - View parameters
     * @param:    $arrmappedOperators [Array] - View parameters operators, to control selection [=, >, <] etc...
     * @param:    $intLimit [Integer]         - The limit amount of records to return [0 returns all records]
     * @param:    $strOrderBy [String]         - The order by column name
     * @param:    $strAscDesc [String]         - The order by column direction [ASC, DESC]
     * @return: $arrObjectView - [Array]     - The returned object view
     */
    public static function getClassView(array $arrView = array(), $blnIsCachable = false, $strCacheKey = false)
    {
        // Define a default set of view arguments
        $arrDefaultView  = array(
            'sql_no_cache' => true,            # use SQL_NO_CACHE
            'ret_object' => false,            # Returns an iQuery Object instead of an array
            'return_sql' => false,            # If the current request should return a recirset or the SQL
            'columns'     =>    '*',            # The columns to be selected, can be an array as well
            'inlineOperators' => false,        # If the operators should be inline like 'filter' => array('a.id <=' => '25')
            'filter'     =>    array(),        # Filter to use in the where clause (ex: id=1)
            'filter_unescaped'    =>    array(),# Filter to use in the where clause but its unescaped, useful for unescaping one of many filter values
            'filter_inline'    =>    array(),    # Filter to use in the where clause but the compare is inline see --> inlineOperators
            'filter_inline_unescaped' =>    array(), # Filter to use in the where clause but the compare is inline see AND ITS unescaped  --> inlineOperators
            'between'    =>    array(),         # Filter to use between ex: $between['latitude'] = array('46.3452345', '54.35645645')
            'operator'     =>    array(),        # The operator to use in the filtering, ex: array('=', '>') :: First param will be id=1 second id > 1 (mapped with the filter value)
            'limit'         =>    false,            # Max amount of rows
            'orderBy'     => 'a.id',            # Order by value
            'direction'  => 'DESC',            # Filtering direction ASC/DESC
            'groupBy'     =>    NULL,            # Group by data,
            'escapeData' =>    true,            # Escape filter data.
            'inner_join' =>    array(),        # Inner join query array
            'left_join'  =>    array(),        # Left join query array
            'having'       => array(),        # Filtering using HAVING claus
            'debug'         =>    false,            # DEBUG true/false
            'forceClass' =>    false,            # Force the class | Used in emulation
            'cacheQuery' =>    false,            # Cache the query true/false
            'cacheTime'  =>    '+30 minute',    # Query cache length
            'search_type'=>    'OR',            # search type: [AND | OR]
            'search'     =>    array()            # search columns: array({column name} => {search keyword}) - The difference
                                            # between search and filter, is that search will perform a regexp filter
                                            # for example searching "Test"  will match "Test, Testing, Tested" etc...
        );

        // Merge the arguments
        $arrViewParams = array_merge(
            (array) $arrDefaultView,
            (array) $arrView
        );

        $strMappedClassName = (((bool) $arrViewParams['forceClass']) ? strtolower($arrViewParams['forceClass']) : strtolower(get_called_class()));
        $objDb              = \Core\Database\Driver\Pdo::getInstance()->setFetchType(\PDO::FETCH_ASSOC);
        $queryParams        = array();
        if (true === $arrViewParams['ret_object'])
        {
            $objDb->setFetchType(\PDO::FETCH_CLASS, $strMappedClassName);
        }

        // Add the columns
        $strQueryColumns = $arrViewParams['columns'];
        if (true === is_array($arrViewParams['columns']))
        {
            $strQueryColumns = '';
            $intFirst        = true;
            foreach ($arrViewParams['columns'] as $intIndex => $strColumnName)
            {
                $strQueryColumns .= ($intFirst ? $strColumnName : ', ' . $strColumnName);
                $intFirst         = false;
            }
        }

        $classRef   = new \ReflectionClass($strMappedClassName);
        $strViewSql = "SELECT SQL_CALC_FOUND_ROWS SQL_" .
                      (true === $arrViewParams['sql_no_cache'] ? "NO_" : "") .
                      "CACHE " .  $strQueryColumns . " FROM " . strtolower($classRef->getShortName()) .  " a ";

        // Add the inner joins joins
        array_walk($arrViewParams['inner_join'], function($strInnerJoinClause, $strTable) use(&$strViewSql) {
            // Backwards compatibility:
            // if the inner_join join array is passed directly as teh array value
            // Ex inner_join = array('table_a ta = on ta.id = tb.tableId')
            // Instead of inner_join = array('table_a ta' => 'ta.id = tb.tableId')
            $strViewSql .= (
                (true === is_string($strTable)) ?
                (' INNER JOIN ' . $strTable . ' ON (' . $strInnerJoinClause . ')') :
                (' INNER JOIN ' . $strInnerJoinClause)
            );
        });

        // Add the left joins
        array_walk($arrViewParams['left_join'], function($strLeftJoinClause, $strTable) use(&$strViewSql) {
            // Backwards compatibility:
            // if the left join array is passed directly as teh array value
            // Ex left_join = array('table_a ta = on ta.id = tb.tableId')
            // Instead of left_join('table_a ta' => 'ta.id = tb.tableId')
            $strViewSql .= (
                (true === is_string($strTable)) ?
                (' LEFT JOIN ' . $strTable . ' ON (' . $strLeftJoinClause . ')') :
                (' LEFT JOIN ' . $strLeftJoinClause )
            );
        });

        // Add the 'Where' Clause!
        $strViewSql .= " WHERE 1=1 ";

        // Add the filter
        $intCount = ((int) sizeof($arrViewParams['filter']));
        $intIndex = 0;
        foreach ($arrViewParams['filter'] as $strColumn => $mxValue) {
            if ($intCount > 0) {
                $strViewSql .= " AND ";
            }
            $operator = (false === $arrViewParams['inlineOperators'] ? (isset($arrViewParams['operator'][$intIndex]) ? " " . $arrViewParams['operator'][$intIndex] . " ": " = ") : '');
            $strViewSql .=     $strColumn . ' ' . $operator;
            // Bind the PDO param
            $paramName               = ':param_' . (mt_rand() * 10000);
            $queryParams[$paramName] = $mxValue;
            $strViewSql             .= $paramName;
            //$strViewSql .=     (is_numeric($mxValue) ? $mxValue : ($arrViewParams['escapeData'] ? "'" . $objDb->escape($mxValue) . "' " : $mxValue . " "));
            --$intCount;
            ++$intIndex;
        }

        // Add the unescaped filter exception
        $intCount = ((int) sizeof($arrViewParams['filter_unescaped']));
        // $intIndex = 0; <-- We do not reset the intIndex because we need a continuance for the operator array since $arrViewParams['filter'] comes first
        foreach ($arrViewParams['filter_unescaped'] as $strColumn => $mxValue) {
            if ($intCount > 0) {
                $strViewSql .= " AND ";
            }
            $operator = (false === $arrViewParams['inlineOperators'] ? (isset($arrViewParams['operator'][$intIndex]) ? " " . $arrViewParams['operator'][$intIndex] . " ": " = ") : '');
            $strViewSql .=     $strColumn . ' ' . $operator . $mxValue;
            --$intCount;
            ++$intIndex;
        }

        // Add the filter_inline exception
        $intCount = ((int) sizeof($arrViewParams['filter_inline']));
        // $intIndex = 0; <-- We do not reset the intIndex because we need a continuance for the operator array since $arrViewParams['filter'] comes first
        foreach ($arrViewParams['filter_inline'] as $strColumn => $mxValue) {
            if ($intCount > 0) {
                $strViewSql .= " AND ";
            }

            $strViewSql .=     $strColumn . ' ';
            $strViewSql .=     (is_numeric($mxValue) ? $mxValue : $objDb->escape($mxValue));
            --$intCount;
            ++$intIndex;
        }

        // Add the filter_inline unescaped exception
        $intCount = ((int) sizeof($arrViewParams['filter_inline_unescaped']));
        // $intIndex = 0; <-- We do not reset the intIndex because we need a continuance for the operator array since $arrViewParams['filter'] comes first
        foreach ($arrViewParams['filter_inline_unescaped'] as $strColumn => $mxValue) {
            if ($intCount > 0) {
                $strViewSql .= " AND ";
            }

            $strViewSql .=     $strColumn . ' ' .  $mxValue;
            --$intCount;
            ++$intIndex;
        }

        // Add the between filter
        $intCount = ((int) sizeof($arrViewParams['between']));
        // $intIndex = 0; <-- We do not reset the intIndex because we need a continuance for the operator array since $arrViewParams['filter'] comes first
        foreach ($arrViewParams['between'] as $strColumn => $arrValues) {
            if ($intCount > 0) {
                $strViewSql .= " AND ";
            }

            $strViewSql .=     '(' . $strColumn . ' BETWEEN ' .  implode(' AND ', $arrValues) . ') ';
        }

        // Add the search by keyword
        $strViewSql    .= ((FALSE === empty($arrViewParams['search'])) ? ' AND (' : '');
        $intCount         = ((int) sizeof($arrViewParams['search']));
        $strSearchType     = ($arrViewParams['search_type'] ? (' ' . $arrViewParams['search_type'] . ' ') : ' OR ');
        while (list($strSearchColumn, $strSearchKeyword) = each($arrViewParams['search']))
        {
            -- $intCount;

            if (empty($strSearchKeyword) === true) {
                continue;
            }
            $strViewSql .= '(' . $strSearchColumn . " REGEXP " . $objDb->escape(trim($strSearchKeyword)) . ") ";
            $strViewSql .= ($intCount > 0 ? $strSearchType : '');
        }
        $strViewSql .= (FALSE === empty($arrViewParams['search']) ? ') ' : '');

        // Add Group By
        $strViewSql .= (strlen($arrViewParams['groupBy']) ? " GROUP BY " . $arrViewParams['groupBy'] . " " : "");

        // Add Having
        $strViewSql .= (false === empty($arrViewParams['having']) ? " HAVING " . implode(' AND ', $arrViewParams['having']) . " " : "");

        // Add Order By
        $strViewSql .= (strlen($arrViewParams['orderBy']) ? " ORDER BY " . $arrViewParams['orderBy'] .
                       (strlen($arrViewParams['direction']) ? " " . $arrViewParams['direction'] . " " : "") : "");

        // Add Limit
        $strViewSql .= ((strlen($arrViewParams['limit']) && ((string) trim($arrViewParams['limit']) !== '0')) ? " LIMIT " . $arrViewParams['limit'] : "");

        // Debug
        if ((bool) $arrViewParams['debug']) {
            //(class_exists('Sql_Formatter')) || require_once(__APPLICATION_ROOT__ . '/debug/sql_formatter.php');
            $callers = debug_backtrace();
            //var_dump($callers); die;
            echo sprintf('<h3>Debugged from [%s::%s] - Line %s</h3>', get_called_class(), $callers[1]['function'], $callers[1]['line']);
            echo \Core\Debug\SqlFormatter::getInstance($strViewSql);
            \Core\Debug\Dump::getInstance($arrViewParams);
            die;
        }


        return (true === $arrViewParams['return_sql'] ?
            $objDb->getSqlQuery($strViewSql, $queryParams) :
                $objDb->getAll($strViewSql, $queryParams));
    }

    /**
     * Backwards compatibility for method getClassView
     *
     * @param:    $arrView [Array]             - View parameters
     * @param:    $arrmappedOperators [Array] - View parameters operators, to control selection [=, >, <] etc...
     * @param:    $intLimit [Integer]         - The limit amount of records to return [0 returns all records]
     * @param:    $strOrderBy [String]         - The order by column name
     * @param:    $strAscDesc [String]         - The order by column direction [ASC, DESC]
     * @return: $arrObjectView - [Array]     - The returned object view
     */
    public static function getObjectClassView(array $arrView = array(), $blnIsCachable = false, $strCacheKey = false)
    {
        return self::getClassView($arrView, $blnIsCachable, $strCacheKey);
    }
}
