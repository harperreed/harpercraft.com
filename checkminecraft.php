<?
$minefold_id = 52147;

$current_players = array();
$f = file_get_contents('https://minefold.com/servers/'.$minefold_id.'.json');
$si = json_decode($f);
$current_players =$si->players;

$p_contact = array('harperreed'=>'harper@nata2.org','acidargyle'=>'aaronsalmon@gmail.com', 'dylanreed'=>'dylan@dylanreed.com');

//print_r($p_contact);

/*
$current_players[]='harperreed';
$current_players[]='acidargyle';
$current_players[]='dylanreed';
*/

//echo "Current players: ";
//print_r($current_players);

$old_players = json_decode(file_get_contents('current_players.json'));
//echo "Old player: ";
//print_r($old_players);

if (count($current_players)>0){
    $diff = array_diff($current_players, $old_players);
    //echo "Diff:";
    //print_r($diff);

}


if (count($diff)>0){

    $potential_players = array_keys($p_contact);
    //echo "Potential players: ";
    //print_r($potential_players);
    if (count($current_players)>0){
        $contact = array_diff( $potential_players, $current_players);
    }

    foreach($contact as $c){
        $contacts[] = $p_contact[$c];
    }
    print_r($contacts);
    $email = <<< EOT

Hello,

Your friend(s) have started playing on your minecraft server ($si->address). You should join them.

The following players are currently on $si->name:


EOT;

    foreach ($current_players as $key => $value) {
        $email .= "\t* ".$value." \n";
    }

    $email .= <<< EOT

Log in and have FUN.

Thanks,
$si->name
EOT;


    foreach ($contacts as $key => $value) {
        echo "Sending email to ".$value."\n";
        sendmail("harper@nata2.org",'notifications@'.$si->address, '['.$si->name.'] Your friends are playing minecraft!',$email);
    }




}
file_put_contents('current_players.json',json_encode($current_players));


function sendmail($to,$from,$subject, $body){

    $url = 'http://sendgrid.com/';
    $user = 'harper@nata2.org';
    $pass = '7815696ecbf1c96';

    $params = array(
        'api_user'  => $user,
        'api_key'   => $pass,
        'to'        => $to,
        'subject'   => $subject,
        'text'      => $body,
        'from'      => $from,
      );

    print_r($params);


    $request =  $url.'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt ($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    //$response = curl_exec($session);
    curl_close($session);

    // print everything out
    return print_r($response,1);
}