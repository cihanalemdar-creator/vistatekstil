(() => {
    const media = document.querySelector('[data-hero-video]');
    const controls = document.querySelector('.hero-video-controls');
    if (!media || !controls) return;

    const video = media.querySelector('video');
    const playButton = controls.querySelector('.hero-video-control--play');
    const muteButton = controls.querySelector('.hero-video-control--mute');
    const playIcon = playButton.querySelector('.hero-video-control__icon');
    const muteIcon = muteButton.querySelector('.hero-video-control__icon');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const mobileViewport = window.matchMedia('(max-width: 767px)');
    let sourceAssigned = false;
    let playbackRequested = false;

    video.muted = true;
    video.defaultMuted = true;
    video.autoplay = true;
    video.loop = true;
    video.playsInline = true;

    const setButton = (button, icon, text, label) => {
        button.setAttribute('aria-label', label);
        button.title = label;
        icon.textContent = text;
        button.querySelector('.hero-video-control__label').textContent = label;
    };

    const updateControls = () => {
        const playing = !video.paused && !video.ended;
        controls.classList.toggle('is-playing', playing);
        setButton(
            playButton,
            playIcon,
            playing ? 'Ⅱ' : '▶',
            playing ? controls.dataset.pauseLabel : controls.dataset.playLabel
        );
        setButton(
            muteButton,
            muteIcon,
            '♪',
            video.muted ? controls.dataset.unmuteLabel : controls.dataset.muteLabel
        );
    };

    const assignSource = () => {
        if (sourceAssigned) return;
        const variant = mobileViewport.matches ? 'mobile' : 'desktop';
        video.poster = video.dataset[`${variant}Poster`];
        const isWebKit = /AppleWebKit/i.test(navigator.userAgent)
            && !/(Chrome|Chromium|Edg|OPR)/i.test(navigator.userAgent);
        const supportsWebm = !isWebKit && video.canPlayType('video/webm; codecs="vp9"') !== '';
        video.src = supportsWebm ? video.dataset[`${variant}Webm`] : video.dataset[`${variant}Mp4`];
        video.load();
        sourceAssigned = true;
    };

    const requestPlayback = () => {
        playbackRequested = true;
        media.classList.remove('is-reduced-motion');
        controls.classList.remove('show-labels');
        assignSource();
        video.muted = true;
        video.defaultMuted = true;
        const promise = video.play();
        if (promise) {
            promise.catch(() => {
                playbackRequested = false;
                media.classList.add('is-autoplay-blocked');
                controls.classList.add('show-labels');
                updateControls();
            });
        }
    };

    video.addEventListener('playing', () => {
        playbackRequested = false;
        media.classList.add('is-playing');
        media.classList.remove('is-autoplay-blocked', 'has-video-error');
        controls.classList.remove('show-labels');
        muteButton.disabled = false;
        muteButton.removeAttribute('aria-hidden');
        updateControls();
    });

    video.addEventListener('pause', () => {
        if (!playbackRequested) updateControls();
    });

    video.addEventListener('volumechange', updateControls);
    video.addEventListener('error', () => {
        playbackRequested = false;
        media.classList.remove('is-playing');
        media.classList.add('has-video-error');
        controls.classList.add('show-labels');
        muteButton.disabled = true;
        muteButton.setAttribute('aria-hidden', 'true');
        updateControls();
    });

    playButton.addEventListener('click', () => {
        if (video.paused || video.ended) {
            requestPlayback();
        } else {
            video.pause();
        }
    });

    muteButton.addEventListener('click', () => {
        video.muted = !video.muted;
        updateControls();
    });

    reducedMotion.addEventListener('change', (event) => {
        if (event.matches) {
            video.pause();
            media.classList.add('is-reduced-motion');
        } else {
            media.classList.remove('is-reduced-motion');
            requestPlayback();
        }
        updateControls();
    });

    updateControls();
    if (reducedMotion.matches) {
        media.classList.add('is-reduced-motion');
        controls.classList.add('show-labels');
    } else {
        requestPlayback();
    }
})();
