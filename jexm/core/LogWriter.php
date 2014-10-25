<?php
	namespace jexm\core;
	
	/**
	* Class handles writing logfiles.
	* 
	* Logfiles must be saved as .log and basename cannot contain
	* characters other than english alphabet, underscore and numeric.
	*/
	class LogWriter{
		
		
		/**
		* Appends an errorlog in specified (defaults to jexmlog) .log file
		* @param string $logMessage Error to write to log
		* @param string $filename OPTIONAL file to write to
		*/
		public function writeLog($logMessage, $filename = "jexmlog"){
			$logfile = $this->replaceCharsConcat($filename);
			$errorLog = $this->createLog($logMessage);
			file_put_contents($logfile,$errorLog,FILE_APPEND);
		}
		
		
		/**
		* Replaces non-allowed characters and checks for existance of file.
		* @param string Basename of logfile
		* @return string Full path to logfile with.log extension. Defaults to jexmlog.log if desired logfile cant be found
		*/
		private function replaceCharsConcat($filename){
			$file = LOG_PATH . preg_replace("/[^0-9_a-zA-Z]/","x",$filename) . ".log";
			return (file_exists($file)) ? $file : LOG_PATH."jexmlog.log";
		}
		
		
		/**
		* Composes a full errorlog to be appended to logfile
		* @param string Errormessage to be logged
		* @return mixed Returns logmessage with time
		*/
		private function createLog($logMessage){
			$errorLog = PHP_EOL . "Logged at " . date("Y-m-d H:i:s") . PHP_EOL; 
			$errorLog .= (!empty($logMessage)) ? $logMessage : "An error occured during logging. Couldnt receive errormessage.";
			$errorLog .= PHP_EOL;
			return $errorLog;
		}

	}