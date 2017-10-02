<?php
class TimeUtil {

	public static function convert($time,$format='') {
		$myDateTime = DateTime::createFromFormat('Y-m-d', $time);
		$newDateString = $myDateTime->format('d-M-Y');
		return $newDateString;
	}

	public static function covertTimeToString($ptime) {
	    $estimate_time = time() - strtotime($ptime);

        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
		$r = round( $d );
		if($r > 14 ) {
			return $ptime;
		}
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
}
