<?php
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>do your tasks</title>
    <link rel="stylesheet" href="css/style.css"
</head>
<body>
   <div class="main-section">
    <div class="add-section">
        <form action="app/add.php" method="POST" autocomplete="off">
            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') {?>
                <input type="text" 
            name="title"
            style="border-color: red;"
             placeholder="write what you want to do!"/>
             <button   type="submit" >add &nbsp; <span>+</span></button>
                <?php } else{?>
            <input type="text" 
            name="title"
             placeholder="type what you need to do"/>
            <button type="submit">add &nbsp; <span>+</span></button>
            <?php }?>
        </form>
        <?php 
         $todo = $conn->query("SELECT * FROM todo ORDER BY id DESC");
        ?>
         



           <?php while($todos = $todo->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="todo-item">
        <span id="<?php echo $todos['id']; ?>" class="remove-to-do">x</span>
        <?php if($todos['checked']) {?>
            <input type="checkbox" data-todos-id="<?php echo $todos['id']; ?>" class="check-box" checked /> 
            <h2 class="checked"><?php echo $todos['title']?></h2>
        <?php } else {?>
            <input type="checkbox" data-todos-id="<?php echo $todos['id']; ?>" class="check-box"/>
            <h2><?php echo $todos['title']?></h2>
        <?php }?>
        <br>
        <small>created: <?php echo $todos['date_time']?></small>

        <!-- Edit Button -->
        <a href="app/edit_task.php?id=<?php echo $todos['id']; ?>">
            <button>Edit <span>&#9998;</span></button>
        </a>
    </div>
<?php }?>

             <div class="show-todo-section">
            
                        <div class="todo-item">
               <img src="img/f.png" width="100%" >
               <img src="img/Ellipsis.gif" width="80px" style="margin-left: 160px;" >
               
                </div>
        
   </div>
    </div>
   </div>
  
   <script src="js/jquery-3.2.1.min.js"></script>
   <script>
    $(document).ready(function(){
$('.remove-to-do').click(function(){
    const id = $(this).attr('id');
    $.post("app/remove.php",
    {
        id: id 
    },
    (data) =>{
        if(data){
            $(this).parent().hide(600);
        }
    }
);
   });
     $(".check-box").click(function(e){
         const id = $(this).attr('data-todos-id');
         $.post('app/check.php',
         {
            id :id
         },
         (data)=>{
           if(data!='error'){
            const h2 = $(this).next()
          if(data === '1'){
            h2.removeClass('checked');
          }else{
             h2.addClass('checked');
          }
           }
         }
        );
     });
    });
   </script>
</body>
</html>

