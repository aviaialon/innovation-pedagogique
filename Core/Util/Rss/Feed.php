<?php 
/**
 * Rss Feed Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */

namespace Core\Util\Rss;

/**
 * Rss Feed Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */
class Feed 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	
	/**
	 * Instantiation method
	 *
	 * @param  string  $fileUrl The file URL or path
	 * @param  integer $limit   The limit of posts to get (-1 for all)
	 * @return \Core\Util\Rss\Feed 
	 */
	public static function getInstance($data = null, $limit = -1, $altUrl = false)
	{
		return new \Core\Util\Rss\Feed($data, $limit, $altUrl);
	}
	
	/**
	 * Class constructor
	 *
	 * @param  string $file_or_url The file URL or path
	 * @param  integer $limit   The limit of posts to get (-1 for all)
	 * @return \Core\Util\Rss\Feed 
	 */
    public function __construct($file_or_url, $limit = -1, $altUrl = false)
    {
		$this->setPosts(array());
        $file_or_url = $this->resolveFile($file_or_url);

        if (!($x = simplexml_load_file($file_or_url))) {
			if (empty($altUrl) === false) {
				return static::getInstance($altUrl, $limit);	
			}
            return;
		}
		
		
		$lmtCount = 0;
        foreach ($x->channel->item as $item)
        {
            $post = new \Core\Util\Rss\RssPost();
			$post->setId($lmtCount + 1);
			$post->setTitle((string) $item->title);
			$post->setLink((string) $item->link);
			$post->setDescription((string) strip_tags($item->description, '<a>'));
			$post->setAuthor((string) $item->author);
			$post->setDate((string) $item->pubDate);
			$post->setTimeStamp(strtotime((string) $item->pubDate));
			$post->setSummary($this->summarizeText($item->description));
			$post->setLongSummary($this->summarizeText($item->description, 245));
			$post->setImage($this->getPostImage($item->enclosure));
			
			
			if ($limit > -1 && $lmtCount >= $limit) {
				break;	
			}
			
			$lmtCount++;
            $this->addPosts($post);
        }
		
		
		$this->setCount(count($this->getPosts()));
    }
	
	/**
	 * This method resolves the file URL
	 *
	 * @param  string $file_or_url The file URL or path
	 * @return string 
	 */
    private function resolveFile($file_or_url) 
	{
        if (!preg_match('|^https?:|', $file_or_url))
            $feed_uri = $_SERVER['DOCUMENT_ROOT'] .'/shared/xml/'. $file_or_url;
        else
            $feed_uri = $file_or_url;

        return $feed_uri;
    }
	
	/**
	 * This method extract the post image from description
	 *
	 * @param  string $summary The rss item descrption
	 * @return string 
	 */
    private function getPostImage($summary) 
	{

		return $summary->attributes()->url ?: '/catalog/products/images/1/56.jpg';
		
		$imageSrc = null;
		$_domDocument = new \DOMDocument();
		try {
			libxml_use_internal_errors(true);
			@$_domDocument->loadHTML($summary);
		} catch (\Exception $e) {}
		
		$imageTags = $_domDocument->getElementsByTagName('img');
		
		if (empty($imageTags) === false) {
			foreach ($imageTags as $img) {
				$imageSrc = $img->getAttribute('src');
				break;	
			}
		}
		
        return $imageSrc;
    }
	
	/**
	 * This method Create summary as a shortened body and remove images,
	 *
	 * @param  string $summary The rss item descrption
	 * @return string 
	 */
    private function summarizeText($summary, $max_len = 100) 
	{
        $summary = strip_tags($summary);

        if (strlen($summary) > $max_len)
            $summary = substr($summary, 0, $max_len) . '...';

        return $summary;
    }
}

/**
 * Rss Post Container Class
 * 
 * @dependencies 	None
 * @author 			Avi Aialon <aviaialon@gmail.com>
 * @package			Core
 * @subpackage		Util
 * @category		Core Utilities
 * @version 		2.0.0
 * @copyright 		(c) 2010 Deviant Logic. All Rights Reserved
 * @license 		CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 * @link			SVN: $HeadURL$
 * @since			12:35:53 PM
 * @example			See below
 * @throws			\Exception
 */
class RssPost 
    extends \Core\Interfaces\Base\ObjectBaseInterface
{
	
}
