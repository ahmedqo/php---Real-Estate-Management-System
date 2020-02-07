<?php
	function Front($pass){
		$str = "";
		$characters = array_merge(range('A','Z'),range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 20; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		$hashfirst = str_split(strrev($str),10)[0];
		$hashlast = str_split(strrev($str),10)[1];
		$pass = strrev(strtoupper($pass));
		$data = $hashfirst.$pass.$hashlast;
		return $data;	
	}
	function Back($pass1,$pass2){
		$pass2 = strrev(strtoupper($pass2));
		$str = "";
		for($i=10;$i<strlen($pass1)-10;$i++)
		{
			$str .= $pass1[$i];
		}
		if($str == $pass2 )
		{
			return 1; 
		}
		else
		{ 
			return 0;
		}
	}
?>

