import './bootstrap';
import { animate, stagger } from 'animejs';

const productCards = [...document.querySelectorAll('.plant-card')];
const filterButtons = [...document.querySelectorAll('[data-plant-filter]')];
const searchInput = document.querySelector('#plant-search');
const emptyState = document.querySelector('.empty-state');
const cartDrawer = document.querySelector('.cart-drawer');
const cartItems = document.querySelector('.cart-items');
const drawerScrim = document.querySelector('.drawer-scrim');
const cart = new Map();
const favorites = new Set();
const storageKey = 'planto-cart-v1';
const favoritesStorageKey = 'planto-favorites-v1';
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
let selectedCategory = 'all';
let reviewIndex = 0;
let toastTimer;

const productById = new Map(productCards.map((card) => [card.dataset.plantId, {
	name: card.dataset.name,
	price: Number(card.dataset.price),
	image: card.querySelector('img').src,
}]));

const showToast = (message) => {
	const toast = document.querySelector('.store-toast');
	if (!toast) return;
	toast.textContent = message;
	toast.classList.add('is-visible');
	window.clearTimeout(toastTimer);
	toastTimer = window.setTimeout(() => toast.classList.remove('is-visible'), 2300);
};

const saveCart = () => {
	try {
		localStorage.setItem(storageKey, JSON.stringify(Object.fromEntries(cart)));
	} catch {
		showToast('Your bag could not be saved on this device.');
	}
};

try {
	const savedCart = JSON.parse(localStorage.getItem(storageKey) || '{}');
	Object.entries(savedCart).forEach(([id, quantity]) => {
		if (productById.has(id) && Number.isInteger(quantity) && quantity > 0) cart.set(id, Math.min(quantity, 99));
	});
} catch {
	try { localStorage.removeItem(storageKey); } catch {}
}

try {
	const savedFavorites = JSON.parse(localStorage.getItem(favoritesStorageKey) || '[]');
	if (Array.isArray(savedFavorites)) savedFavorites.filter((id) => productById.has(id)).forEach((id) => favorites.add(id));
} catch {
	try { localStorage.removeItem(favoritesStorageKey); } catch {}
}

const renderCart = () => {
	if (!cartItems || !cartDrawer) return;
	let totalQuantity = 0;
	let subtotal = 0;
	cartItems.replaceChildren();

	cart.forEach((quantity, id) => {
		const product = productById.get(id);
		if (!product) return;
		totalQuantity += quantity;
		subtotal += product.price * quantity;

		const item = document.createElement('article');
		item.className = 'cart-item';
		item.innerHTML = `<img src="${product.image}" alt=""><div><h3>${product.name}</h3><p>Rs. ${product.price}</p><div class="quantity-control"><button type="button" data-quantity="-1" data-product-id="${id}" aria-label="Remove one ${product.name}">−</button><span>${quantity}</span><button type="button" data-quantity="1" data-product-id="${id}" aria-label="Add one ${product.name}">+</button></div></div><button type="button" class="cart-item__remove" data-remove-product="${id}" aria-label="Remove ${product.name}">×</button>`;
		cartItems.append(item);
	});

	document.querySelector('[data-cart-count]').textContent = String(totalQuantity);
	document.querySelector('.cart-trigger').setAttribute('aria-label', `Open shopping bag, ${totalQuantity} items`);
	document.querySelector('[data-drawer-count]').textContent = `(${totalQuantity})`;
	document.querySelector('[data-cart-subtotal]').textContent = `Rs. ${subtotal.toLocaleString('en-IN')}`;
	cartDrawer.classList.toggle('is-empty', totalQuantity === 0);
};

const addToCart = (id) => {
	if (!productById.has(id)) return;
	cart.set(id, Math.min((cart.get(id) || 0) + 1, 99));
	saveCart();
	renderCart();
	if (!prefersReducedMotion.matches) {
		animate('.icon-bag', { scale: [1, 1.35, 1], duration: 420, ease: 'outBack' });
	}
	showToast(`${productById.get(id).name} added to your bag.`);
};

const setCartOpen = (isOpen) => {
	if (!cartDrawer || !drawerScrim) return;
	cartDrawer.classList.toggle('is-open', isOpen);
	cartDrawer.setAttribute('aria-hidden', String(!isOpen));
	drawerScrim.hidden = !isOpen;
	document.body.classList.toggle('cart-open', isOpen);
	if (isOpen) cartDrawer.querySelector('.cart-close').focus();
};

const applyCatalogFilters = () => {
	const query = searchInput?.value.trim().toLocaleLowerCase() || '';
	let visibleCount = 0;
	productCards.forEach((card) => {
		const matchesCategory = selectedCategory === 'all' || card.dataset.category.split(' ').includes(selectedCategory);
		const matchesSearch = !query || card.dataset.name.toLocaleLowerCase().includes(query);
		card.hidden = !(matchesCategory && matchesSearch);
		if (!card.hidden) visibleCount += 1;
	});
	if (emptyState) emptyState.hidden = visibleCount > 0;
};

filterButtons.forEach((button) => button.addEventListener('click', () => {
	selectedCategory = button.dataset.plantFilter;
	filterButtons.forEach((filterButton) => {
		const isSelected = filterButton === button;
		filterButton.classList.toggle('is-active', isSelected);
		filterButton.setAttribute('aria-pressed', String(isSelected));
	});
	applyCatalogFilters();
	if (!prefersReducedMotion.matches) {
		const visibleCards = productCards.filter((card) => !card.hidden);
		visibleCards.forEach((card) => card.classList.remove('anime-pending'));
		animate(visibleCards, { opacity: [0.55, 1], y: [12, 0], delay: stagger(55), duration: 420, ease: 'outExpo' });
	}
}));

searchInput?.addEventListener('input', applyCatalogFilters);
document.querySelector('.search-trigger')?.addEventListener('click', (event) => {
	const panel = document.querySelector('.search-panel');
	const isExpanded = event.currentTarget.getAttribute('aria-expanded') === 'true';
	event.currentTarget.setAttribute('aria-expanded', String(!isExpanded));
	panel.hidden = isExpanded;
	if (!isExpanded) searchInput.focus();
	else {
		searchInput.value = '';
		applyCatalogFilters();
	}
});
document.querySelector('.search-close')?.addEventListener('click', () => {
	document.querySelector('.search-panel').hidden = true;
	document.querySelector('.search-trigger').setAttribute('aria-expanded', 'false');
	searchInput.value = '';
	applyCatalogFilters();
});

document.querySelectorAll('[data-add-product]').forEach((button) => button.addEventListener('click', () => addToCart(button.dataset.addProduct)));
document.querySelectorAll('.favorite-button').forEach((button) => {
	const id = button.closest('.plant-card').dataset.plantId;
	button.setAttribute('aria-pressed', String(favorites.has(id)));
	button.textContent = favorites.has(id) ? '♥' : '♡';
	button.addEventListener('click', () => {
		const isFavorite = favorites.has(id);
		if (isFavorite) favorites.delete(id);
		else favorites.add(id);
		button.setAttribute('aria-pressed', String(!isFavorite));
		button.textContent = isFavorite ? '♡' : '♥';
		try { localStorage.setItem(favoritesStorageKey, JSON.stringify([...favorites])); } catch {}
		if (!prefersReducedMotion.matches) animate(button, { scale: [1, 1.35, 1], duration: 380, ease: 'outBack' });
		showToast(isFavorite ? 'Removed from your favorites.' : 'Saved to your favorites.');
	});
});

document.querySelector('.cart-trigger')?.addEventListener('click', () => setCartOpen(true));
document.querySelector('.cart-close')?.addEventListener('click', () => setCartOpen(false));
drawerScrim?.addEventListener('click', () => setCartOpen(false));
document.querySelector('[data-continue-shopping]')?.addEventListener('click', () => setCartOpen(false));
cartItems?.addEventListener('click', (event) => {
	const quantityButton = event.target.closest('[data-quantity]');
	const removeButton = event.target.closest('[data-remove-product]');
	if (quantityButton) {
		const id = quantityButton.dataset.productId;
		const nextQuantity = Math.min((cart.get(id) || 0) + Number(quantityButton.dataset.quantity), 99);
		if (nextQuantity > 0) cart.set(id, nextQuantity);
		else cart.delete(id);
		saveCart();
		renderCart();
	}
	if (removeButton) {
		cart.delete(removeButton.dataset.removeProduct);
		saveCart();
		renderCart();
	}
});
document.querySelector('.checkout-button')?.addEventListener('click', () => showToast('Checkout is a demo and is not connected yet.'));

const storeNavigation = document.querySelector('.store-nav');
const storeMenu = document.querySelector('.store-menu-trigger');
const closeStoreMenu = () => {
	storeNavigation?.classList.remove('is-open');
	storeMenu?.setAttribute('aria-expanded', 'false');
	storeMenu?.setAttribute('aria-label', 'Open navigation');
};
storeMenu?.addEventListener('click', () => {
	const isOpen = storeMenu.getAttribute('aria-expanded') === 'true';
	storeMenu.setAttribute('aria-expanded', String(!isOpen));
	storeMenu.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
	storeNavigation?.classList.toggle('is-open', !isOpen);
	if (!isOpen && !prefersReducedMotion.matches) {
		animate(storeNavigation.querySelectorAll('a'), { opacity: [0, 1], x: [10, 0], delay: stagger(45), duration: 300, ease: 'outExpo' });
	}
});
storeNavigation?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeStoreMenu));

document.querySelector('[data-story-open]')?.addEventListener('click', () => {
	const dialog = document.querySelector('.story-dialog');
	dialog.showModal();
	if (!prefersReducedMotion.matches) animate(dialog, { opacity: [0, 1], scale: [0.96, 1], duration: 380, ease: 'outExpo' });
});
document.querySelector('.story-dialog__close')?.addEventListener('click', () => document.querySelector('.story-dialog').close());
document.querySelector('[data-story-shop]')?.addEventListener('click', () => document.querySelector('.story-dialog').close());
document.querySelector('[data-show-category]')?.addEventListener('click', () => {
	filterButtons.find((button) => button.dataset.plantFilter === 'statement')?.click();
});

const reviewTrack = document.querySelector('.review-track');
const reviewPosition = document.querySelector('.review-controls span');
const moveReview = (direction) => {
	if (!reviewTrack || !reviewPosition) return;
	if (direction > 0) reviewTrack.append(reviewTrack.firstElementChild);
	else reviewTrack.prepend(reviewTrack.lastElementChild);
	reviewIndex = (reviewIndex + direction + reviewTrack.children.length) % reviewTrack.children.length;
	reviewPosition.innerHTML = `${String(reviewIndex + 1).padStart(2, '0')} <i>/</i> 03`;
	if (!prefersReducedMotion.matches) {
		animate(reviewTrack.children, { opacity: [0.55, 1], y: [8, 0], delay: stagger(45), duration: 360, ease: 'outExpo' });
	}
};
document.querySelector('[data-review-next]')?.addEventListener('click', () => moveReview(1));
document.querySelector('[data-review-prev]')?.addEventListener('click', () => moveReview(-1));

document.addEventListener('keydown', (event) => {
	if (event.key === 'Escape') {
		setCartOpen(false);
		closeStoreMenu();
		const searchPanel = document.querySelector('.search-panel');
		searchPanel.hidden = true;
		document.querySelector('.search-trigger').setAttribute('aria-expanded', 'false');
	}
});

const yearElement = document.querySelector('[data-year]');
if (yearElement) yearElement.textContent = String(new Date().getFullYear());
renderCart();

const pointerTiltEnabled = window.matchMedia('(hover: hover) and (pointer: fine)');
if (pointerTiltEnabled.matches && !prefersReducedMotion.matches) {
	const addPointerTilt = (element, tiltXProperty, tiltYProperty, maxTilt = 7) => {
		element.addEventListener('pointermove', (event) => {
			const bounds = element.getBoundingClientRect();
			const horizontal = (event.clientX - bounds.left) / bounds.width;
			const vertical = (event.clientY - bounds.top) / bounds.height;
			element.style.setProperty(tiltXProperty, `${(0.5 - vertical) * maxTilt}deg`);
			element.style.setProperty(tiltYProperty, `${(horizontal - 0.5) * maxTilt}deg`);
		});
		element.addEventListener('pointerleave', () => {
			element.style.setProperty(tiltXProperty, '0deg');
			element.style.setProperty(tiltYProperty, '0deg');
		});
	};

	const heroFeature = document.querySelector('.hero-feature');
	if (heroFeature) addPointerTilt(heroFeature, '--feature-tilt-x', '--feature-tilt-y', 8);
	productCards.forEach((card) => addPointerTilt(card, '--card-tilt-x', '--card-tilt-y', 6));
}

if (!prefersReducedMotion.matches) {
	animate('.store-header', { opacity: [0, 1], y: [-12, 0], duration: 650, ease: 'outExpo' });
	const heroContent = document.querySelector('.plant-hero__content');
	if (heroContent) {
		animate(heroContent.querySelectorAll('.plant-kicker, h1, .plant-hero__copy, .hero-buttons'), {
			opacity: [0, 1], y: [24, 0], delay: stagger(105), duration: 850, ease: 'outExpo',
		});
	}
	animate('.hero-feature', { opacity: [0, 1], scale: [0.92, 1], duration: 1000, delay: 160, ease: 'outExpo' });
	animate('.hero-review', { opacity: [0, 1], x: [-18, 0], duration: 700, delay: 360, ease: 'outExpo' });

	const revealTargets = [...document.querySelectorAll('.plant-section > .section-title, .plant-section > .category-tabs, .plant-grid, .review-section, .collection-feature')];
	if ('IntersectionObserver' in window) {
		const revealObserver = new IntersectionObserver((entries, observer) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) return;
				entry.target.classList.remove('anime-pending');
				if (entry.target.matches('.plant-grid')) {
					animate(entry.target.children, { opacity: [0, 1], y: [22, 0], scale: [0.97, 1], delay: stagger(75), duration: 680, ease: 'outExpo' });
				} else {
					animate(entry.target, { opacity: [0, 1], y: [24, 0], duration: 760, ease: 'outExpo' });
				}
				observer.unobserve(entry.target);
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -5% 0px' });

		revealTargets.forEach((target) => {
			target.classList.add('anime-pending');
			revealObserver.observe(target);
		});
	} else {
		animate(revealTargets, { opacity: [0, 1], y: [24, 0], delay: stagger(80), duration: 760, ease: 'outExpo' });
	}
}
