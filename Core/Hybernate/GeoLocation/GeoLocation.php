<?php 
namespace Core\Hybernate\GeoLocation;
/**
 * GeoLocation management used with Hybernate loader
 *
 * @package    Core
 * @subpackage Interfaces
 * @file       Core/Interfaces/Base/HybernateBaseInterface.php
 * @desc       Used interface for ORM implementations
 * @author     Avi Aialon
 * @license    BSD/GPLv2
 *
 * copyright (c) Avi Aialon (DeviantLogic)
 * This source file is subject to the BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */
class GeoLocation extends \Core\Interfaces\HybernateInterface 
{
	/**
     * Called before the getInstance
     *
     * @access protected
     * @param  mixed $identifier identifier passed to get instance
     * @return \Core\Interfaces\Base\HybernateBaseInterface
     */
	protected function onBeforeGetInstance($identifier = null) 
	{
		if (empty($identifier) === false) {
			self::$_identityBinding = ip2long($identifier);	
		}
	}
	
	/**
     * Called after the getInstance
     *
     * @access protected
     * @param  mixed $identifier identifier passed to get instance
     * @return \Core\Interfaces\Base\HybernateBaseInterface
     */
	protected function onGetInstance($identifier = null) 
	{
		if ($this->getId() === 0) {
			$Application = \Core\Application::getInstance();
			$curlHandle  = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $Application->getConfigs()->get('Application.core.geolocation.api_url') . 
								'?' . http_build_query(array(
									'key' 	 => $Application->getConfigs()->get('Application.core.geolocation.api_key'),
									'ip'	 => $_SERVER['REMOTE_ADDR'],
									'format' => 'json'				  
								)));
			curl_setopt($curlHandle, CURLOPT_POST, false);
			curl_setopt($curlHandle, CURLOPT_HTTPGET, true);
			curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 3);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT, 10);
			
			$_geoLocationData = curl_exec($curlHandle);
			
			if (false === $_geoLocationData) {
				$errorHandler = \Core\Exception\Exception::log(sprintf(
					'Geolocation service is currently unavailable. [Curl Error No: %s | %s]', curl_errno($curlHandle), curl_error($curlHandle)));	
			}
			
			$geoLocationData = @json_decode($_geoLocationData, true);

			if (null === $geoLocationData) {
				$errorHandler = \Core\Exception\Exception::log(sprintf(
					'Geolocation service returned invalid data. [%s | %s]', $_geoLocationData, curl_error($curlHandle)));	
			}
			
			$this->setId(ip2long($geoLocationData['ipAddress']));
			$this->setIp($geoLocationData['ipAddress']);
			$this->setCountryCode($geoLocationData['countryCode']);
			$this->setCountryName($geoLocationData['countryName']);
			$this->setRegionName($geoLocationData['regionName']);
			$this->setCityName($geoLocationData['cityName']);
			$this->setZip($geoLocationData['zipCode']);
			$this->setLat($geoLocationData['latitude']);
			$this->setLng($geoLocationData['longitude']);
			$this->setTimeZone($geoLocationData['timeZone']);
			$this->save(true);
		}
	}
}
