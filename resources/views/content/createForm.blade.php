<div class="form-group">
    <label for="name">Name</label>
        {!! Form::text('name' , null, [
           'class' => 'form-control'
        ]) !!}

    <label for="age">Age</label>
        {!! Form::text('age' , null, [
           'class' => 'form-control'
        ]) !!}

    <label for="image">Image</label>
        {!! Form::file('image' , null, [
           'class' => 'form-control'
        ]) !!}
    </br>

    <label for="gender_id">Gender</label>
        {!! Form::select('gender_id',$gender->pluck('name', 'id')->toArray()  ,null, [
           'class' => 'form-control'
        ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>