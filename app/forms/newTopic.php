<h2 class="header">Create a new topic!</h2>
<?php 
if (isset($_SESSION['errorMessage'])) {
    echo '<div class="alert alert-danger" role="alert"><h3 class="subheader">Dang! 😢</h3>' . $_SESSION['errorMessage'] . '</div>';
    unset($_SESSION['errorMessage']);
}
?>
<form class="form" action="./controllers/topicCreator.php" method="post">
    <div class="form-group">
        <label for="topicName">Name</label>
        <input type="text" class="form-control" name="topicName" id="topicName" aria-describedby="Topic name" placeholder="Enter the name of new topic..." value="<?php if(isset($_SESSION['errorTopicName'])){
            echo $_SESSION['errorTopicName'];
            unset($_SESSION['errorTopicName']);
        }
       ?>" required>
    </div>
    <div class="form-group">
        <label for="topicDescription">Topic description (500 chracters max)</label>
        <textarea class="form-control" name="topicDescription" id="topicDescription" rows="3" placeholder="Briefly introduce the topic to your audience ..." required><?php if(isset($_SESSION['errorTopicDescription'])){
            echo $_SESSION['errorTopicDescription'];
            unset($_SESSION['errorTopicDescription']);
        }
       ?></textarea>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="isPublic" id="isPublic">
        <label class="form-check-label" for="isPublic" value="1">Accessible for registered users only?</label>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>