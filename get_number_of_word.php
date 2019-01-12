<pre><?php

function get_numb($str)
{

	$temp_juta = [];
	$temp_ribu = [];
	$val_juta = '0';
	$val_ribu = '0';
	$val_satu = '0';

	$exp = explode(' ', $str);

	if( in_array('juta', $exp) ) {
		$q = array_search('juta', $exp);
		$r = count($exp);
		$t = [];
		for ($i=0; $i < $r; $i++) { 
			if($i < $q) {
				$temp_juta[] = $exp[$i];
			} else {
				if($i != $q) {
					$t[] = $exp[$i];
				}
			}
		}
		$val_juta = get_gab($temp_juta).'000000';
		$exp = [];
		$exp = $t;
	}

	if( in_array('ribu', $exp)) {
		$q = array_search('ribu', $exp);
		$t = [];
		for ($i=0; $i < count($exp); $i++) { 
			if($i < $q) {
				$temp_ribu[] = $exp[$i];
			} else {
				if($i != $q) $t[] = $exp[$i];
			}
		} //for
		$val_ribu = get_gab($temp_ribu).'000';
		$exp = [];
		$exp = $t;
	}

	$val_satu = get_gab($exp);

	$total = $val_juta + $val_ribu + $val_satu;

	return $total;

}

function get_gab($arr) {

	$translate_angka = [
		'satu'			=> '1',
		'dua'				=> '2',
		'tiga'			=> '3',
		'empat'			=> '4',
		'lima'			=> '5',
		'enam'			=> '6',
		'tujuh'			=> '7',
		'delapan'		=> '8',
		'sembilan'	=> '9',
		'sepuluh'		=> '10',
		'sebelas'		=> '11',
		'seratus'		=> '100',
		'seribu'		=> '1000',
	];

	$satuan = [
		'juta'	=> '000000',
		'ribu'	=> '000',
		'ratus'	=> '00',
		'puluh'	=> '0',
	];

	$angka = 0;
	$angka_satuan = 1;

	for ($i=0; $i < count($arr); $i++) { 
	
		if($i == $angka )
		{
			$a = '';
			$b = '';
			$angka = $i+2;

			$a = $translate_angka[$arr[$i]];

			if(isset($arr[$i+1]))
			{
				if( $arr[$i] == 'seratus' )
				{
					$angka = $i+1;
					$angka_satuan = 5;
				}
				else
				if( $arr[$i+1] == 'belas' )
				{
					$a = $a+10;
					$angka = $i+3;
					$angka_satuan = 2;
				}
				else
				{
					$angka = $i+2;
					$angka_satuan = 1;
				}

				if( $arr[$i] != 'seratus' && isset($arr[$i+$angka_satuan]))
				{
					$b = $satuan[$arr[$i+$angka_satuan]];
				}
			}  // kalo ada belakangnya
			$x[] = $a.$b;
		}
	}

	$total = 0;
	for ($i=0; $i < count($x); $i++) { 
		$total += $x[$i];
	}
	return $total;
}

echo get_numb('lima ratus empat belas juta tiga ribu tiga puluh lima').'

';
echo get_numb('sembilan puluh sembilan ribu delapan ratus empat puluh dua').'

';
echo get_numb('sembilan ratus sembilan puluh sembilan juta sembilan ratus sembilan puluh sembilan ribu sembilan ratus sembilan puluh sembilan').'

';
echo get_numb('empat ratus lima puluh delapan juta satu').'

';
echo get_numb('dua ratus juta seratus delapan puluh delapan ribu satu').'

';
echo get_numb('seratus tiga juta empat ratus tujuh puluh ribu tujuh ratus enam').'

';
echo get_numb('empat puluh lima juta seratus ribu sembilan puluh').'

';
echo get_numb('lima puluh juta sembilan').'

';
echo get_numb('tujuh puluh juta tujuh ratus ribu seratus').'

';
echo get_numb('tujuh').'

';
echo get_numb('sebelas').'

';
echo get_numb('seratus').'

';
echo get_numb('sepuluh').'

';
echo get_numb('satu').'

';
echo get_numb('lima juta empat belas').'

';
echo get_numb('tujuh juta delapan ratus sembilan puluh tujuh ribu delapan ratus lima puluh sembilan').'

';
?>
