<?php 

	/**
	* @library	RandGen
	* @author 	Daniel Omoniyi
	* @link 	https://www.github.com/danielthegeek/RandGen 
	* @license	http://opensource.org/licenses/MIT	MIT License
	* @version	1.0.0
	**/


	class Rand_gen
	{	
		private function randomize($string,$len) 
		{
			$result="";
			$charArray = str_split($string);
			for($i= 0; $i < $len; $i++) { 
				$randItem = array_rand($charArray);
				$result .= "".$charArray[$randItem];
			}
			return $result;	
		}

		/** 
		*  Generate method accepts two arguments
		*  @param Int $len: String length
		*  @param String $type - [alpha|numeric|alpha_numeric]  
		*  @param Array $config
		*  @return $output
		**/

		public function generate($len, $type='', $config=[], $crypt=FALSE) 
		{	 
			// Default options, not seperated because it's just about three configs
			if (empty($config)) 
			{
				$config = [
					'prefix'		=>	'',
					'suffix'		=>	'',
					'TTG'			=>	0
				];	
			}

			// Validating $len
			else if (!is_numeric($len)) {
				throw new Exception("Expected a numerical value as string length not \"$len\"", 1);
			}
			
			// Making sure the provided option set is an array
			if (is_array($config)) 
			{	
				foreach ($config as $option => $value) 
				{
					if (!isset($config['TTG'])) {
						$config['TTG'] = 0;
					}
					$time = time() + $config['TTG'];

					// Reset the max_execution_time to TTG value + 60
					ini_set('max_execution_time', $config['TTG'] + 60);
					do {
						// String $type
						switch ($type) 
						{
							case 'alpha':
								$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
								$output = $this->randomize($chars,$len);
							break;
							case 'numeric':
								$chars = "0123456789";
								$output = $this->randomize($chars,$len);
							break;
							case 'alpha-numeric':
								$chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
								$output = $this->randomize($chars,$len);
							break;
							default:
								$chars = "abcdefghi\$jklmnopqrstuvwxyzU\$VW01QRST23E\FGHI/456JKLMNOP\$78XYZ9ABCD";
								$randChars = md5(md5(sqrt(time()).$chars)).$chars;
								$output = $this->randomize($randChars,$len);
							break;
						}		
					} while (time() < $time);

					switch ($option) {
						case 'prefix':
							if ($config['prefix'] && strlen(isset($config['suffix'])) == 0) {
								return $config['prefix'].$output;	
							} else {
								return $config['prefix'].$output.$config['suffix'];	
							}
						break;
						case 'suffix':
							if ($config['suffix'] && strlen(isset($config['prefix'])) == 0) {
								return $output.$config['suffix'];	
							} else {
								return $config['suffix'].$output.$config['prefix'];		
							}
						break;
						// To do: add batch random string generation
						default:
							return $output;
						break;
					}
				}
			}
		}

		private function crypt($input) {
			return crypt($input);	
		}
	}
?>