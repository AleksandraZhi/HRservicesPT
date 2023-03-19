const targetShow = document.querySelectorAll('section:not(#section__hero)')
const targetHide = document.querySelector('#observer-hero')
let section = ''

// below fixing issue with navbar links not scrolling to the right section because of the fixed navbar
document.addEventListener('click', function (event) {
	if (!event.target.matches('#header__nav--main .nav-link')) return
	event.preventDefault()
	section = document.querySelector(event.target.dataset.href)
	const scrollDistance =
		window.pageYOffset + section.getBoundingClientRect().top - 85
	window.scroll(0, scrollDistance)
})

// below is observer to highlight navbar when scrolling down
const optionsShow = {
	threshold: 0.3,
}
const optionsHide = {
	threshold: 1,
}

function handleIntersectionShow(entries) {
	entries.map(entry => {
		if (entry.isIntersecting) {
			// console.log('show')
			document
				.querySelector('#header__nav--main .navbar')
				.classList.add('active')
			observerShow.unobserve(entry.target)
		}
	})
}

function handleIntersectionHide(entry) {
	if (entry.isIntersecting) {
		// console.log('hide')
		document
			.querySelector('#header__nav--main .navbar')
			.classList.remove('active')
		observerHide.unobserve(entry.target)
	}
}

const observerShow = new IntersectionObserver(
	handleIntersectionShow,
	optionsShow
)
const observerHide = new IntersectionObserver(
	handleIntersectionHide,
	optionsHide
)

if (targetShow) {
	targetShow.forEach(target => observerShow.observe(target))
}

if (targetHide) {
	observerHide.observe(targetHide)
}
