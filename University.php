<?php

class University
{
    private PDO $db;

    public function __construct()
    {
        $dsn = "mysql:host=127.0.0.1;dbname=university";
        $user = "root";
        $pass = "";
        $this->db = new PDO($dsn, $user, $pass);
    }

    public function groups(): void
    {
        $statement = $this->db->query("SELECT DISTINCT * FROM groups");
        while ($data = $statement->fetch()) {
            echo "<option value='$data[0]'>$data[1]</option>";
        }
    }

    public function teachers(): void
    {
        $statement = $this->db->query("SELECT DISTINCT * FROM teacher");
        while ($data = $statement->fetch()) {
            echo "<option value='$data[0]'>$data[1]</option>";
        }
    }

    public function auditoriums(): void
    {
        $statement = $this->db->query("SELECT DISTINCT auditorium FROM lesson");
        while ($data = $statement->fetch()) {
            echo "<option value='$data[0]'>$data[0]</option>";
        }
    }

    public function tableByGroup($group): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson INNER JOIN lesson_groups ON ID_Lesson = FID_Lesson2 
    WHERE FID_Groups = ?");
        $statement->execute([$group]);
        echo "<table>";
        echo " <tr>
     <th> Week Day  </th>
     <th> Lesson Number </th>
     <th> Auditorium </th>
     <th> Disciple </th>
     <th> Type </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            echo " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        echo "</table>";
    }

    public function tableByTeacher($teacher): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson INNER JOIN lesson_teacher ON ID_Lesson = FID_Lesson1
    WHERE FID_Teacher = ?");
        $statement->execute([$teacher]);
        echo "<table>";
        echo " <tr>
     <th> Week Day  </th>
     <th> Lesson Number </th>
     <th> Auditorium </th>
     <th> Disciple </th>
     <th> Type </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            echo " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        echo "</table>";
    }

    public function tableByAuditorium($auditorium): void
    {
        $statement = $this->db->prepare("SELECT week_day, lesson_number, auditorium, disciple, type 
    FROM lesson
    WHERE auditorium = ?");
        $statement->execute([$auditorium]);
        echo "<table>";
        echo " <tr>
     <th> Week Day  </th>
     <th> Lesson Number </th>
     <th> Auditorium </th>
     <th> Disciple </th>
     <th> Type </th>
    </tr> ";
        while ($data = $statement->fetch()) {
            echo " <tr>
         <td> {$data['week_day']}  </td>
         <td> {$data['lesson_number']} </td>
         <td> {$data['auditorium']} </td>
         <td> {$data['disciple']} </td>
         <td> {$data['type']} </td>
        </tr> ";
        }
        echo "</table>";
    }

    public function addLesson($week_day, $lesson_number, $auditorium, $disciple, $type, $teacher, $group): void
    {
        $statement = $this->db->prepare("INSERT INTO lesson (week_day, lesson_number, auditorium, disciple, `type`) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([$week_day, $lesson_number, $auditorium, $disciple, $type]);
        $lessonId = $this->db->lastInsertId();
        $statement = $this->db->prepare("INSERT INTO lesson_teacher (FID_Teacher, FID_Lesson1) VALUES (?, ?)");
        $statement->execute([$teacher, $lessonId]);
        $statement = $this->db->prepare("INSERT INTO lesson_groups (FID_Groups, FID_Lesson2) VALUES (?, ?)");
        $statement->execute([$group, $lessonId]);
    }
}