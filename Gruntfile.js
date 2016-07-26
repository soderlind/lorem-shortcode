/*
 * Based on http://torquemag.io/automating-wordpress-plugin-updates-releases-grunt/
 *
 * added:
 *        copy:svn_assets task
 *        makepot, creates wp-anchor-header.pot
 */
module.exports = function (grunt) {

	/**
	 * Files added to WordPress SVN, don't include 'assets/**' here.
	 * @type {Array}
	 */
	svn_files_list = [
		'readme.txt',
		'lorem-shortcode.php',
	];

	/**
	 * Let's add a couple of more files to GitHub
	 * @type {Array}
	 */
	git_files_list = svn_files_list.concat([
		'README.md',
		'package.json',
		'Gruntfile.js',
		'assets/**'
	]);

	// Project configuration.
	grunt.initConfig({
		pkg : grunt.file.readJSON( 'package.json' ),
		clean: {
			post_build: [
				'build'
			]
		},
		copy: {
			svn_assets: {
				options : {
					mode :true
				},
				expand: true,
				cwd:  'assets/',
				src:  '**',
				dest: 'build/<%= pkg.name %>/assets/',
				flatten: true,
				filter: 'isFile'
			},
			svn_trunk: {
				options : {
					mode :true
				},
				expand: true,
				src: svn_files_list,
				dest: 'build/<%= pkg.name %>/trunk/'
			},
			svn_tag: {
				options : {
					mode :true
				},
				expand: true,
				src:  svn_files_list,
				dest: 'build/<%= pkg.name %>/tags/<%= pkg.version %>/'
			},

		},
		gittag: {
			addtag: {
				options: {
					tag: '<%= pkg.version %>',
					message: 'Version <%= pkg.version %>'
				}
			}
		},
		gitcommit: {
			commit: {
				options: {
					message: 'Version <%= pkg.version %>',
					noVerify: true,
					noStatus: false,
					allowEmpty: true
				},
				files: {
					src: git_files_list
				}
			}
		},
		gitpush: {
			push: {
				options: {
					tags: true,
					remote: 'origin',
					branch: 'master'
				}
			}
		},
		replace: {
			reamde_md: {
				src: [ 'README.md' ],
				overwrite: true,
				replacements: [{
					from: /~Current Version:\s*(.*)~/,
					to: "~Current Version: <%= pkg.version %>~"
				}, {
					from: /Latest Stable Release:\s*\[(.*)\]\s*\(https:\/\/github.com\/soderlind\/wp-anchor-header\/releases\/tag\/(.*)\s*\)/,
					to: "Latest Stable Release: [<%= pkg.git_tag %>](https://github.com/soderlind/wp-anchor-header/releases/tag/<%= pkg.git_tag %>)"
				}]
			},
			reamde_txt: {
				src: [ 'readme.txt' ],
				overwrite: true,
				replacements: [{
					from: /Stable tag: (.*)/,
					to: "Stable tag: <%= pkg.version %>"
				}]

			},
			plugin_php: {
				src: [ '<%= pkg.main %>' ],
				overwrite: true,
				replacements: [{
					from: /Version:\s*(.*)/,
					to: "Version: <%= pkg.version %>"
				}]
			}
		},
		svn_export: {
		    dev: {
		      options: {
		        repository: 'http://plugins.svn.wordpress.org/<%= pkg.name %>',
		        output: 'build/<%= pkg.name %>'
		    	}
		    }
		},
		push_svn: {
			options: {
				remove: true
			},
			main: {
				src: 'build/<%= pkg.name %>',
				dest: 'http://plugins.svn.wordpress.org/<%= pkg.name %>',
				tmp: 'build/make_svn'
			}
		},
		changelog: {
		    sample: {
		      options: {
		      	fileHeader: '# Changelog',
		      	dest: 'CHANGELOG.md',
		      	after: '2013-03-01',
		        logArguments: [
		          '--pretty=- [%ad](https://github.com/soderlind/<%= pkg.name %>/commit/%h): %s (committer: %cn)',
		          '--no-merges',
		          '--date=short'
		        ],
		        template: '{{> features}}',
		        featureRegex: /^(.*)$/gim,
		        partials: {
		          features: '{{#if features}}{{#each features}}{{> feature}}{{/each}}{{else}}{{> empty}}{{/if}}\n',
		          feature: '{{this}} {{this.date}}\n'
		        }
		      }
		    }
		},
		makepot: {
		    target: {
		        options: {
		            domainPath: '/languages',
		            potHeaders: {
		                poedit: true,
		                'x-poedit-keywordslist': true
		            },
		            bugsurl: '<%= pkg.bugs.url%>',
		            processPot: function( pot, options ) {
	                    pot.headers['report-msgid-bugs-to'] = options.bugsurl;
	                    /*pot.headers['language-team'] = 'Team Name <team@example.com>';*/
	                    return pot;
	                },
		            type: 'wp-plugin',
		            updateTimestamp: true,
		            exclude: [
		            	'languages/.*',
		            	'js/.*',
		            	'node_modules/.*'
		            ]
		        }
		    }
		}
	});



	//load modules
	// grunt.loadNpmTasks( 'grunt-glotpress' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-git' );
	grunt.loadNpmTasks( 'grunt-text-replace' );
	grunt.loadNpmTasks( 'grunt-svn-export' );
	grunt.loadNpmTasks( 'grunt-push-svn' );
	grunt.loadNpmTasks( 'grunt-remove' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-changelog' );

	grunt.registerTask('syntax', 'default task description', function(){
	  console.log('Syntax:\n' +
	  				'\tgrunt release (pre_vcs, do_svn, do_git, clean:post_build)\n' +
	  				'\tgrunt pre_vcs (update plugin version number in files, create .pot file)\n' +
	  				'\tgrunt do_svn (svn_export, copy:svn_trunk, copy:svn_tag, push_svn)\n' +
	  				'\tgrunt update_svn (copy:svn_trunk, copy:svn_tag, push_svn)\n' +
	  				'\tgrunt do_git (gitcommit, gittag, gitpush)'
	  	);
	});

	grunt.registerTask( 'default', ['syntax'] );
	grunt.registerTask( 'version_number', [ 'replace:reamde_md', 'replace:reamde_txt', 'replace:plugin_php' ] );
	grunt.registerTask( 'pre_vcs', [ 'version_number', 'makepot'] );

	grunt.registerTask( 'do_svn', [ 'svn_export', 'copy:svn_assets', 'copy:svn_trunk', 'copy:svn_tag', 'push_svn' ] );
	grunt.registerTask( 'update_svn', [ 'copy:svn_assets', 'copy:svn_trunk', 'copy:svn_tag', 'push_svn' ] );
	grunt.registerTask( 'do_git', [ 'gitcommit', 'gittag', 'gitpush' ] );
	grunt.registerTask( 'release', [ 'pre_vcs', 'do_svn', 'do_git', 'clean:post_build' ] );

};
