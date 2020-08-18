
$(document).ready((evt) => {
    console.log('Home js')
    console.log('var: ', loginData);

    $('#col-posts').on('click', '#btn-like', (evt) => {
        let target = $(evt.target);
        let data = {
            usuario_id: loginData.usuario_id,
            post_id: target.data('postid')
        }
        let parent = target.parent();
        // console.log(parent.parent().parent());
        let likesCount = parent.parent().parent().find('#likes_count');
        console.log(likesCount);

        if (target.hasClass('c-red')) {
            console.log('tiene')
            target.removeClass('fa-heart');
            target.addClass('fa-heart-o');
            target.removeClass('c-red');
            //hacemos dislike
            darLikeOrDislike(data);
            let likes = parseInt(likesCount.text());
            likesCount.text(`${likes - 1}`);
        } else {
            console.log('no tiene')
            target.removeClass('fa-heart-o');
            target.addClass('fa-heart');
            target.addClass('c-red');
            //hacemos like
            darLikeOrDislike(data);
            let likes = parseInt(likesCount.text());
            likesCount.text(`${likes + 1}`);
        }


    });

    function darLikeOrDislike(data) {
        // let response = await fetch('/article/fetch/post/user', {
        console.log('send data: ', data)
        fetch('/like', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('input[name="_token"]').val()
            },
            body: JSON.stringify(data)
        }).then((response) => response.json())
            .then(function (myJson) {
                console.log(myJson);

            })
            .catch(function (response) {
                console.log('respuesta error', response)

            });

    }
});