<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rrogers
 * Date: 12/20/12
 * Time: 9:15 AM
 *
 */
class Entry extends AppModel
{
    public $belongsTo = array('Task');

    public function afterFind($results, $primary = false)
    {
        if ($primary === true) {
            //Add hour values for start and end times
            $hourFormat = 'g:i';
            foreach($results as $key=>$result)
            {
                $result['Entry']['start_time_hours'] = date($hourFormat, strtotime($result['Entry']['start_time']));
                $result['Entry']['end_time_hours'] = date($hourFormat, strtotime($result['Entry']['end_time']));
                $results[$key] = $result;
            }
        }
        return $results;
    }
}
