<div class="form-group">
    <label for="name">Name</label>
        {!! Form::text('name' , $content->name, [
           'class' => 'form-control'
        ]) !!}

    <label for="age">Age</label>
        {!! Form::text('age' , $content->age, [
           'class' => 'form-control'
        ]) !!}

    <label for="image">Image</label>
        {!! Form::file('image' , null, [
           'class' => 'form-control'
        ]) !!}
    </br>

    <label for="gender_id">Gender</label>
        {!! Form::select('gender_id',$gender,$content->gender->id, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button id = "save" class="btn btn-primary">Submit</button>
</div>