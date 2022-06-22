<?php
require_once "University.php";
$university = new University();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB1</title>
</head>

<body>
<p>

<form action="" method="get">
    <p><strong> Groups` lessons </strong>
        <select name='group'>
            <option>Group</option>
            <?php
            $university->groups();
            ?>
        </select>
        <button>Submit</button>
    </p>
</form>

<form action="" method="get">
    <p><strong> Teachers` lessons </strong>
        <select name='teacher'>
            <option>Teacher</option>
            <?php
            $university->teachers();
            ?>
        </select>
        <button>Submit</button>
    </p>

</form>

<form action="" method="get">
    <p><strong> Lessons by auditoriums </strong>
        <select name='auditorium'>
            <option>Auditoriums</option>
            <?php
            $university->auditoriums();
            ?>
        </select>
        <button>Submit</button>
    </p>
</form>
<?php
if(isset($_REQUEST["group"])) {
    $university->tableByGroup($_REQUEST["group"]);
} else if(isset($_REQUEST["teacher"])) {
    $university->tableByTeacher($_REQUEST["teacher"]);
} else if(isset($_REQUEST["auditorium"])){
    $university->tableByAuditorium($_REQUEST["auditorium"]);
}
?>
<p><b>Add new lesson</b></p>
    <form method="get" action="">
        <p>Day</p>
        <select name='day'>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>    
        </select>
        <p>Lesson Number</p>
        <input name="lesson_number" type="number" value="1" min="1" max="6" step="1">
        <p>Auditorium</p>
        <input required name="auditorium">
        <p>Disciple</p>
        <input required name="disciple">
        <p>Disciple</p>
        <input required name="type">
        <p><b> Teacher<select name="name">
            <?php
                $university->teachers();
            ?> </select>
        <p><b> Group<select name="group">
                    <?php
                    $university->groups();
                    ?> </select>
            <button>Submit</button></b></p>
        </form>
        <?php
            if(isset($_REQUEST['day'])
            && isset($_REQUEST['lesson_number'])
            && isset($_REQUEST['auditorium'])
            && isset($_REQUEST['disciple'])
            && isset($_REQUEST['name'])
            && isset($_REQUEST['type'])) {
                $university->addLesson($_REQUEST["day"], $_REQUEST["lesson_number"], $_REQUEST["auditorium"], $_REQUEST["disciple"], $_REQUEST["type"], $_REQUEST["name"], $_REQUEST["group"]);
            }
            ?>

</body>

</html>