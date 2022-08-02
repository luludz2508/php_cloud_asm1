<header>
    <nav>
        <ul class="nav__link">
            <li><a href="/">1st Question</a></li>
            <li><a href="/advance?page=1">2nd Question</a></li>
            <li><a href="/statistics?page=1">3rd Question</a></li>
        </ul>
    </nav>

</header>

<script>window.addEventListener("scroll", function() {
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    });
</script>

