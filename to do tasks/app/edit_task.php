<?php
if(isset($_POST['title']) && isset($_POST['id'])) {
    require '../db_conn.php';

    $title = $_POST['title'];
    $id = $_POST['id'];

    if(empty($title)) {
        header("Location: ../index.php?mess=error");
    } else {
        $stmt = $conn->prepare("UPDATE todo SET title = ? WHERE id = ?");
        $res = $stmt->execute([$title, $id]);
        if($res) {
            header("Location: ../index.php?mess=success");
        } else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
} elseif(isset($_GET['id'])) {
    require '../db_conn.php';
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM todo WHERE id = ?");
    $stmt->execute([$id]);
    $todo = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ../index.php?mess=error");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            background: #34495e;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background: #34495e;
        }
        .main-section {
            background: transparent;
            max-width: 500px;
            width: 90%;
            height: 500px;
            margin: 30px auto;
            border-radius: 10px;
        }
        .editsection {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 #ccc, 0 6px 20px 0 #ccc;
        }
        .input {
            width: 100%;
            height: 40px;
            margin: 10px auto;
            border: 2px solid #ccc;
            font-size: 16px;
            border-radius: 5px;
            padding: 0px 5px;
            box-sizing: border-box;
        }
        .edit-button {
            width: 100%;
            height: 40px;
            margin: 0px auto;
            border: none;
            outline: none;
            background: #0088ff;
            color: #fff;
            font-family: sans-serif;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .edit-button:hover {
            box-shadow: 0 2px 2px 0 #ccc, 0 2px 3px 0 #ccc;
            opacity: 0.7;
        }
    </style>
</head>
<body>
   <div class="main-section">
    <div class="editsection">
        <form action="edit_task.php" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input class="input" type="text" name="title" placeholder="Edit Task Title" value="<?php echo $todo['title']; ?>">
            <button type="submit" class="edit-button">Edit</button>
        </form>
        
            
            
                      
              
        
   </div>
    </div>
   </div>
</body>
</html>
