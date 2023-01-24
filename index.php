<pre>
<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

echo '<hr>';
function getFullnameFromParts($sur, $name, $pat){    
    return $sur.' '.$name.' '.$pat;
}

for ($i = 0; $i < count($example_persons_array); $i ++) {
    $fullname = $example_persons_array[$i]['fullname'];
    $fullname = getPartsFromFullname($fullname);
    $sur = $fullname['surname'];
    $name = $fullname['name'];
    $pat = $fullname['patronomyc'];
    echo getFullnameFromParts($sur, $name, $pat).'<br>';
}

echo '<hr>';

function getPartsFromFullname($fullname){
    $nameKeys = ['surname', 'name', 'patronomyc'];
    $fullname = explode(' ', $fullname);
    $fullname = array_combine($nameKeys, $fullname);
    return $fullname;
}

for ($i = 0; $i < count($example_persons_array); $i ++) { 
print_r(getPartsFromFullname($example_persons_array[$i]['fullname']));
}

echo '<hr>';

function getShortName($fullname){  
    $a = getPartsFromFullname($fullname);
    return mb_substr($a['surname'],0,5).' '.mb_substr($a['name'],0,1);
}

for ($i = 0; $i < count($example_persons_array); $i ++) {
    $a = $example_persons_array[$i]['fullname'];
    echo getShortName($a).'<br>';
}

echo '<hr>';

function getGenderFromName($fullname){ 
    $fullname = getPartsFromFullname($fullname); 
    $gender=0;
    $sur = $fullname['surname'];
    $n = $fullname['name'];
    $pat = $fullname['patronomyc'];

    if (str_ends_with($sur, "ва")|| str_ends_with($n, 'а') || str_ends_with($pat, 'вна')){    
        return $gender-1;
    } elseif (str_ends_with($sur, "в") || str_ends_with($n, 'й'||'н') || str_ends_with($pat, 'ич')){
        return $gender+1;  
    } else {
        return $gender=0;
    }
}

for ($i = 0; $i < count($example_persons_array); $i ++) {
    $a = $example_persons_array[$i]['fullname'];
    echo getGenderFromName($a);
}



echo '<hr>';

function getGenderDescription($array){ 
    for ($i = 0; $i < count($array); $i ++) {
        $a = $array[$i]['fullname'];
        $arr[]=$a;      
        }
        
        foreach($arr as $user){
            if (getGenderFromName($user)>0){
                $mail[] = $user;
            } elseif (getGenderFromName($user)<0){
                $fem[] = $user;
            } else {
                $nan[] = $user;
            }            
        }
        $full=count($arr);
        $num_m=(100/$full * (count($mail)));
        $num_m=round($num_m, 1);
        $num_f=(100/$full * (count($fem)));
        $num_f=round($num_f, 1);
        $num_n=(100/$full * (count($nan)));
        $num_n=round($num_n, 1);

        $statistics = <<<MYHEREDOCTEXT
        Гендерный состав аудитории:
        ---------------------------
        Мужчины - $num_m %;
        Женщины - $num_f%;
        Не удалось определить - $num_n%.
        MYHEREDOCTEXT;

        echo $statistics;
}

for ($i = 0; $i < count($example_persons_array); $i ++) {    
	$fullname = $example_persons_array[$i]['fullname'];
	$fullname1 = explode(' ', $fullname);
	$fullnames[] = $fullname;
    $fullnames1[] = $fullname1;
}
getGenderDescription($example_persons_array);

echo '<hr>';

//print_r($fullnames[0][0]);   
//echo

function getPerfectPartner($sur, $name, $pat, $array){
    $sur=mb_convert_case($sur, MB_CASE_TITLE_SIMPLE);
    $name=mb_convert_case($name, MB_CASE_TITLE_SIMPLE);
    $pat=mb_convert_case($pat, MB_CASE_TITLE_SIMPLE);

    $fullname = getFullnameFromParts($sur, $name, $pat);
    $gend = getGenderFromName($fullname);

    for ($i = 0; $i < count($array); $i ++) {    
        $fullname1 = $array[$i]['fullname'];
        $fullnames[] = $fullname1;
    }
    
    do{
    $fullname1 = $fullnames[rand(0, count($fullnames)-1)];
    $gend1 = getGenderFromName($fullname1);
    } while($gend===$gend1);

    $fullname = getShortName($fullname);
    $fullname1 = getShortName($fullname1);
    $num = round((rand(50, 100)+lcg_value()), 2);

    echo <<<MYHEREDOCTEXT
    $fullname. + $fullname1. = 
    ♡ Идеально на $num% ♡
    MYHEREDOCTEXT;
}

getPerfectPartner('ПотаПОва', 'ЛиДИЯ', 'ИВАновна', $example_persons_array);

?>
</pre>