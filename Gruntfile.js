module.exports = function(grunt) {
	// Project configuration
	grunt.initConfig({
		concat: {
			js: {
				src: ['bower_components/fitvids/jquery.fitvids.js'],
				dest: 'build/js/scripts.js',
    		}
  		},
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
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// Register Tasks
	grunt.registerTask('default', ['sass', 'watch']);
};