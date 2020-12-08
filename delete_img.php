<div class='col-3 mt-5'>
    <div class='card h-100'>
        <img src='" . $image_file_path . $thumb_file_name[$i] . "' class='w-100'>
        <div class='card-body'>
            <p class='card-text'>$image_file_name[$i]</p>
        </div>
        <div class='card-footer bg-transparent border-success'>
            <button type='button' class='btn btn-secondary btn-sm delimg text-center'
                value='" . $image_file_name[$i] . "'>削除</button>
        </div>
    </div>
</div>