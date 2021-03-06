module.exports = function(grunt) {
	// Project configuration
	grunt.initConfig({
  		sass: {                                    // Task
	  		dist: {                                // Target
		  		options: {                         // Target options
			  		style: 'compressed'
			  	},
			  	files: {                           // Dictionary of files
				  	'style.css': 'sass/style.scss' // 'destination': 'source'
				}
			}
		},
		criticalcss: {
			home: {
				options: {
					url: "https://olegs.be/",
					width: 1200,
					height: 900,
					outputfile: "critical-home.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
			about: {
				options: {
					url: "https://olegs.be/product-manager-torino-web-performance-user-experience/",
					width: 1200,
					height: 900,
					outputfile: "critical-about.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
			landing: {
				options: {
					url: "https://olegs.be/ottimizzazione-prestazioni-velocita-sito-web-lento/",
					width: 1200,
					height: 900,
					outputfile: "critical-landing.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
			blog: {
				options: {
					url: "https://olegs.be/blog/",
					width: 1200,
					height: 900,
					outputfile: "critical-blog.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
			photos: {
				options: {
					url: "https://olegs.be/photos/",
					width: 1200,
					height: 900,
					outputfile: "critical-photos.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
			gallery: {
				options: {
					url: "https://olegs.be/gallery/turin-italy/",
					width: 1200,
					height: 900,
					outputfile: "critical-gallery.css",
					filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			},
		},
		watch: {
  			css: {
  				files: ['sass/*.css', 'sass/*.scss'],
  				tasks: ['sass'],
  			},
		},
	});
	// Load Tasks
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-criticalcss');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// Register Tasks
	grunt.registerTask('default', ['sass', 'criticalcss', 'watch']);
};
