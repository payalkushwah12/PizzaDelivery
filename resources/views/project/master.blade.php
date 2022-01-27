<!doctype html>
<html lang="en">
    <head>
    @include('project.includes.head')
    </head>
    <body>
        <main>
            <header>
                @include('project.includes.nav')
            </header>
            <section class="container">
                @yield('content')
            </section>
        </main>
    </body>
    @include('project.includes.foot')
</html>