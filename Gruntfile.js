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
		watch: {
  			css: {
  				files: ['sass/*.css', 'sass/*.scss'],
  				tasks: ['sass'],
  			},
		},
	});
	// Load Tasks
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// Register Tasks
	grunt.registerTask('default', ['sass', 'watch']);
};