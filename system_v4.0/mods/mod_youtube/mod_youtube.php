<!-- mod_youtube.php -->
<link rel="stylesheet" href="mods/mod_youtube/mod_youtube.css?<?php echo filemtime('mods/mod_youtube/mod_youtube.css'); ?>">

<div class="modulo-ytube">
    <div class="ytube-columna-1">
        <div class="video-container">
            <div id="video-player"></div>
        </div>
        <div class="carousel-wrapper">
            <div class="carousel-container" id="video-list"></div>
        </div>
    </div>
</div>

<script>
    const feedURL = 'https://c2k.cl/system_v3.5.5/mods/mod_youtube/youtube-proxy.php';

    function fetchYouTubeFeed() {
        fetch(feedURL)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(data, "application/xml");
                const entries = xmlDoc.querySelectorAll("entry");

                let videoList = '';
                const videoIds = [];

                entries.forEach(entry => {
                    const title = entry.querySelector("title").textContent;
                    const link = entry.querySelector("link").getAttribute('href');
                    const videoId = link.split("v=")[1];
                    const thumbnail = `https://img.youtube.com/vi/${videoId}/mqdefault.jpg`;
                    videoIds.push(videoId);

                    videoList += `
                        <div class="carousel-item" data-video-id="${videoId}">
                            <img src="${thumbnail}" alt="${title}">
                            <h3>${title}</h3>
                        </div>
                    `;
                });

                const carouselContainer = document.getElementById('video-list');
                carouselContainer.innerHTML = videoList + videoList; // Duplicar el contenido
                setupVideoClicks();
                startCarouselAnimation();

                // Cargar un video aleatorio por defecto
                const randomVideoId = videoIds[Math.floor(Math.random() * videoIds.length)];
                loadYouTubePlayer(randomVideoId);
            })
            .catch(error => {
                console.error('Error fetching YouTube feed:', error);
            });
    }

    function loadYouTubePlayer(videoId) {
        const playerContainer = document.getElementById('video-player');
        playerContainer.innerHTML = `
            <iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        `;
    }

    function setupVideoClicks() {
        document.querySelectorAll('.carousel-item').forEach(item => {
            item.addEventListener('click', () => {
                const videoId = item.getAttribute('data-video-id');
                loadYouTubePlayer(videoId);
            });

            item.addEventListener('mouseenter', () => {
                document.querySelector('.carousel-container').style.animationPlayState = 'paused';
            });

            item.addEventListener('mouseleave', () => {
                document.querySelector('.carousel-container').style.animationPlayState = 'running';
            });
        });
    }

    function startCarouselAnimation() {
        document.querySelector('.carousel-container').style.animationPlayState = 'running';
    }

    fetchYouTubeFeed();
</script>
