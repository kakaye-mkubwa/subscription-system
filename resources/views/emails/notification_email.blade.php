<html lang="en">
    <head>
        <title>{{$subscriber->name}}</title>
    </head>
    <body>
        <h1>New Post Alert!</h1>
        <p>Hi, {{ $post->title }}</p>
        <p>{{$post->description}}</p>
        <a href="{{ $post->url }}">Click here to view the post</a>
        <p>Thank you,</p>
    </body>
</html>
