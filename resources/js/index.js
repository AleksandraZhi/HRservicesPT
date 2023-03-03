const targetShow = document.querySelectorAll('#section__services')
const targetHide = document.querySelector('#section__hero')
const optionsShow = {
	threshold: 0.3,
}
const optionsHide = {
	threshold: 1,
}

function handleIntersectionShow(entries) {
	entries.map(entry => {
		if (entry.isIntersecting) {
			console.log('show')
			document
				.querySelector('#header__nav--main .navbar')
				.classList.add('active')
			observerShow.unobserve(entry.target)
		}
	})
}

function handleIntersectionHide(entry) {
	if (entry.isIntersecting) {
		console.log('hide')
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
targetShow.forEach(target => observerShow.observe(target))
observerHide.observe(targetHide)
