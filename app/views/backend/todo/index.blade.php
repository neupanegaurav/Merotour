@section('title')
List of Todos :: @parent
@stop

@section('content')
<ul>
<?php foreach ($entries as $entry) :?>

    <li><a href="<?php echo URL::action('TodoController@show', array('id' => $entry->id)); ?>"> <?php echo $entry->name; ?> </a></li>
    
    
<?php endforeach; ?>
</ul>

<?php echo $entries->links(); ?>

@stop
