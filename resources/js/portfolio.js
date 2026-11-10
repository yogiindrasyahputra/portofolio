const navigation = document.querySelector('.main-nav');
const navigationToggle = document.querySelector('.nav-toggle');
const filterButtons = [...document.querySelectorAll('[data-filter]')];
const projectCards = [...document.querySelectorAll('.project-card')];
const visibleCount = document.querySelector('[data-visible-count]');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const pageProgress = document.querySelector('[data-page-progress]');
const reelPlayer = document.querySelector('[data-reel-player]');
const reelToggle = document.querySelector('[data-reel-toggle]');
const reelIcon = document.querySelector('[data-reel-icon]');
const reelScene = document.querySelector('[data-reel-scene]');
const reelProgress = document.querySelector('[data-reel-progress]');
const reelSections = [...document.querySelectorAll('.hero, #work, #about, #expertise, #contact')];
const reelNames = ['INTRO', 'SELECTED WORK', 'ABOUT', 'EXPERTISE', 'CONTACT'];
const reelDurations = [5200, 4300, 3900, 3900, 3500];
let reelIndex = 0;
let reelTimer;
let scrollFrame;
let reelPlaying = false;

document.documentElement.classList.add('js-ready');

const heroOrb = document.querySelector('.hero-orb');
if (heroOrb && !reducedMotion.matches && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
	window.addEventListener('pointermove', (event) => {
		const x = event.clientX / window.innerWidth - 0.5;
		const y = event.clientY / window.innerHeight - 0.5;
		heroOrb.style.setProperty('--orb-x', `${x * 22}px`);
		heroOrb.style.setProperty('--orb-y', `${y * 18}px`);
		heroOrb.style.setProperty('--orb-rotate-x', `${-y * 7}deg`);
		heroOrb.style.setProperty('--orb-rotate-y', `${x * 9}deg`);
	}, { passive: true });
}

const closeNavigation = () => {
	navigation?.classList.remove('is-open');
	navigationToggle?.setAttribute('aria-expanded', 'false');
	navigationToggle?.setAttribute('aria-label', 'Buka navigasi');
};

navigationToggle?.addEventListener('click', () => {
	const isOpen = navigationToggle.getAttribute('aria-expanded') === 'true';
	navigationToggle.setAttribute('aria-expanded', String(!isOpen));
	navigationToggle.setAttribute('aria-label', isOpen ? 'Buka navigasi' : 'Tutup navigasi');
	navigation?.classList.toggle('is-open', !isOpen);
});

navigation?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeNavigation));

filterButtons.forEach((button) => button.addEventListener('click', () => {
	const selectedFilter = button.dataset.filter;
	let shown = 0;
	filterButtons.forEach((filterButton) => {
		const isSelected = filterButton === button;
		filterButton.classList.toggle('is-active', isSelected);
		filterButton.setAttribute('aria-pressed', String(isSelected));
	});
	projectCards.forEach((card) => {
		const isVisible = selectedFilter === 'all' || card.dataset.category === selectedFilter;
		card.classList.toggle('is-hidden', !isVisible);
		if (isVisible) shown += 1;
	});
	if (visibleCount) visibleCount.textContent = String(shown).padStart(2, '0');
}));

if ('IntersectionObserver' in window && !reducedMotion.matches) {
	const revealObserver = new IntersectionObserver((entries, observer) => {
		entries.forEach((entry) => {
			if (!entry.isIntersecting) return;
			entry.target.classList.add('is-visible');
			observer.unobserve(entry.target);
		});
	}, { threshold: 0.14, rootMargin: '0px 0px -30px 0px' });
	document.querySelectorAll('[data-reveal]').forEach((element) => revealObserver.observe(element));
} else {
	document.querySelectorAll('[data-reveal]').forEach((element) => element.classList.add('is-visible'));
}

const year = document.querySelector('[data-year]');
if (year) year.textContent = String(new Date().getFullYear());

window.addEventListener('resize', () => {
	if (window.innerWidth > 720) closeNavigation();
}, { passive: true });

const updateReelControls = () => {
	reelToggle?.setAttribute('aria-label', reelPlaying ? 'Jeda putaran' : 'Lanjutkan putaran');
	if (reelIcon) reelIcon.textContent = reelPlaying ? 'Ⅱ' : '▶';
};

const showReelScene = (index) => {
	const section = reelSections[index];
	if (!section) return;
	reelIndex = index;
	if (reelScene) reelScene.textContent = reelNames[index];
	const progress = Math.round(((index + 1) / reelSections.length) * 100);
	if (reelProgress) reelProgress.style.width = `${progress}%`;
	reelPlayer?.querySelector('[role="progressbar"]')?.setAttribute('aria-valuenow', String(progress));
	const startY = window.scrollY;
	const targetY = startY + section.getBoundingClientRect().top;
	const startTime = performance.now();
	const duration = reducedMotion.matches ? 0 : 1100;
	window.cancelAnimationFrame(scrollFrame);
	const scrollFrameToScene = (time) => {
		const progress = duration === 0 ? 1 : Math.min((time - startTime) / duration, 1);
		const easedProgress = 1 - Math.pow(1 - progress, 3);
		window.scrollTo(0, startY + (targetY - startY) * easedProgress);
		if (progress < 1 && reelPlaying) scrollFrame = window.requestAnimationFrame(scrollFrameToScene);
	};
	scrollFrame = window.requestAnimationFrame(scrollFrameToScene);
};

const scheduleReelScene = () => {
	window.clearTimeout(reelTimer);
	reelTimer = window.setTimeout(() => {
		if (!reelPlaying) return;
		if (reelIndex >= reelSections.length - 1) {
			reelPlaying = false;
			if (reelScene) reelScene.textContent = 'SELESAI';
			updateReelControls();
			return;
		}
		showReelScene(reelIndex + 1);
		scheduleReelScene();
	}, reelDurations[reelIndex]);
};

const pauseReel = () => {
	if (!reelPlaying) return;
	reelPlaying = false;
	window.clearTimeout(reelTimer);
	window.cancelAnimationFrame(scrollFrame);
	if (reelScene) reelScene.textContent = 'DIJEDA';
	updateReelControls();
};

document.querySelector('[data-reel-start]')?.addEventListener('click', () => {
	reelPlayer.hidden = false;
	reelPlaying = true;
	showReelScene(0);
	updateReelControls();
	scheduleReelScene();
});

reelToggle?.addEventListener('click', () => {
	if (reelPlaying) {
		pauseReel();
		return;
	}
	reelPlayer.hidden = false;
	reelPlaying = true;
	if (reelScene?.textContent === 'SELESAI' || reelScene?.textContent !== 'DIJEDA') showReelScene(0);
	else window.scrollTo({ top: reelSections[reelIndex].offsetTop, behavior: reducedMotion.matches ? 'auto' : 'smooth' });
	if (reelScene) reelScene.textContent = reelNames[reelIndex];
	updateReelControls();
	scheduleReelScene();
});

document.querySelector('[data-reel-exit]')?.addEventListener('click', () => {
	pauseReel();
	reelPlayer.hidden = true;
});

window.addEventListener('wheel', (event) => {
	if (!event.target.closest('.reel-player')) pauseReel();
}, { passive: true });
window.addEventListener('touchstart', (event) => {
	if (!event.target.closest('.reel-player')) pauseReel();
}, { passive: true });
window.addEventListener('keydown', (event) => {
	if (!event.target.closest('button, a, input, textarea, select') && ['ArrowDown', 'ArrowUp', 'PageDown', 'PageUp', 'Home', 'End', ' '].includes(event.key)) pauseReel();
});

const updatePageProgress = () => {
	if (!pageProgress) return;
	const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
	const progress = scrollableHeight > 0 ? (window.scrollY / scrollableHeight) * 100 : 0;
	pageProgress.style.width = `${progress}%`;
};

window.addEventListener('scroll', updatePageProgress, { passive: true });
updatePageProgress();