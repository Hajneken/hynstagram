<h2 class="header">Create a new topic!</h2>
<form class="form">
    <div class="form-group">
        <label for="topicName">Name</label>
        <input type="text" class="form-control" id="topicName" aria-describedby="Topic name" placeholder="Enter the name of new topic...">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
        <label for="topicDescription">Topic description</label>
        <textarea class="form-control" id="topicDescription" rows="3" placeholder="Briefly introduce the topic to your audience ..."></textarea>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Accessible for registered users only</label>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>