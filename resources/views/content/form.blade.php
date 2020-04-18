<div class="form-group">
    <label for="name">Name</label>
        {!! Form::text('name' , $model->name, [
           'class' => 'form-control'
        ]) !!}

    <label for="age">Age</label>
        {!! Form::text('age' , $model->age, [
           'class' => 'form-control'
        ]) !!}

    <label for="image">Image</label>
        {!! Form::file('image' , null, [
           'class' => 'form-control'
        ]) !!}
    </br>

    <label for="gender">Gender</label>
        {!! Form::select('gender',array('male', 'female') ,null, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>