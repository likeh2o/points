<?php
define("SHIFT",5);
define("MASK", 0x1f);

class OrderBitMap{
	/**
	 * bit map
	 */
	private $_bitMapArray = array();
	public function __construct(){
		
	}

	/**
	 * set bit map
	 */
	private function setBitMap($num){
		$temp = (1 << ($num & MASK));
		$key = $num >> SHIFT;
		if(isset($this->_bitMapArray[$key])){
			$this->_bitMapArray[$key] |= $temp;
		}else{
			$this->_bitMapArray[$key] = $temp;
		}
	}

	/**
	 * sort
	 */
	public function sort($nums = array()){
		foreach($nums as $n) {
			$this->setBitMap($n);
		}
	}

	/**
	 * show sort nums
	 */
	public function show(){
		ksort($this->_bitMapArray);
		foreach($this->_bitMapArray as $k=>$num){
			$len = 0;
			while($len<=MASK) {
				if($num&pow(2,$len)){
					echo $k*(MASK+1) + $len,"<br/>";
				}
				$len++;
			}
		}
	}
}

$nums = array(1, 74, 4, 256, 1024, 110, 111, 112, 123, 112, 100,1983,100000,343434,22,1234,4555,666666,677777,77777676,56,45,4534,434,34,3);

$obm = new OrderBitMap();
$obm->sort($nums);
$obm->show();

/* 1
0000 0000 0000 0000 0000 0000 0000 0001
&
0000 0000 0000 0000 0000 0000 0001 1111
=
0000 0000 0000 0000 0000 0000 0000 0001
<<
0000 0000 0000 0000 0000 0000 0000 0010

18:==============================4=3210
0000 0000 0000 0000 0000 0000 0001 0010

1024:
0000 0000 0000 0000 0000 0100 0000 0000
*/

