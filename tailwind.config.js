/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['./dist/**/*.{html,js,jsx,ts,tsx,vue}', './public/**/*.html'],
	theme: {
		extend: {
			colors: {
				'celestial-blue': '#3292ca',
				'india-red': '#eb5957',
				'honolulu-blue': '#017ac3',
				'Aero-blue': '#19c3e3',
			},
			// fontFamily:{
			// 	poppins: ['Poppins', 'sans-serif'],
			// }
		},
		// screens: {
		// 	'phone':'300px',
		// 	// => @media (min-width: 300px) { ... }

		// 	'tablet': '640px',
		// 	// => @media (min-width: 640px) { ... }
	  
		// 	'laptop': '1024px',
		// 	// => @media (min-width: 1024px) { ... }
	  
		// 	'desktop': '1280px',
		// 	// => @media (min-width: 1280px) { ... }
		//   },
	},
	plugins: ['prettier-plugin-tailwindcss'],
};
