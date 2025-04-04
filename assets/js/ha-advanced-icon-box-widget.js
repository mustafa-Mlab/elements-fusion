(function ($) {
  function initializeLottieAnimations($scope) {
      // Ensure Lottie is loaded
      console.log(typeof lottie );
      if (typeof lottie === 'undefined') {
          console.error('Lottie library is not loaded.');
          return;
      }

      $scope.find('.lottie-animation:not(.lottie-initialized)').each(function () {
          const lottieUrl = $(this).data('lottie-url');
          const loop = $(this).data('lottie-loop');
          const hoverBehavior = $(this).data('hover-behavior'); // 'none', 'play', 'pause', 'reverse'
          const speed = parseFloat($(this).data('animation-speed')) || 1; // Default speed = 1

          $(this).addClass('lottie-initialized');

          // Load Lottie animation
          const animation = lottie.loadAnimation({
              container: this,
              renderer: 'svg',
              loop: loop === 'true',  // Ensure loop is a boolean
              autoplay: true,
              path: lottieUrl,
          });

          // Set speed
          animation.setSpeed(speed);

          // Hover behavior control
          $(this).hover(
              function () {
                  // Mouse enter
                  if (hoverBehavior === 'play') {
                      animation.play();
                  } else if (hoverBehavior === 'pause') {
                      animation.pause();
                  } else if (hoverBehavior === 'reverse') {
                      animation.setDirection(-1); // Reverse direction
                      animation.play();
                  }
              },
              function () {
                  // Mouse leave
                  if (hoverBehavior === 'play') {
                      animation.stop(); // Stop animation when hover out (optional)
                  } else if (hoverBehavior === 'pause') {
                      animation.play(); // Resume animation
                  } else if (hoverBehavior === 'reverse') {
                      animation.setDirection(1); // Forward direction
                      animation.play();
                  }
              }
          );
      });
  }

  $(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/ha_advanced_icon_box.default', function ($scope) {
          initializeLottieAnimations($scope);
      });
  });
})(jQuery);
