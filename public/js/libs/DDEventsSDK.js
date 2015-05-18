// Copyright © DoubleDutch 2014

(function () {
    function throwNotInitialized() {
        throw new Error("DD Events SDK runtime not initialized");
    }

    var onReadyCallbacks = [];
    var DD = {
        Events: {
            // Subscribe by passing a callback to onReady.
            // Callbacks will be called after the DD Events Platform is initialized.
            onReady: function (callback) {
                if (onReadyCallbacks) {
                    onReadyCallbacks.push(callback);
                } else {
                    setTimeout(callback, 1);
                }
            },

            /// Get Current User
            getCurrentUserImplementation: function () { this.getCurrentUserCallback({ UserId: 1, EmailAddress: '', FirstName: 'Jordan', LastName: 'Joz' }); },
            getCurrentUserAsync: function (callback) {
                this.getCurrentUserCallback = callback;
                this.getCurrentUserImplementation();
            },

            /// Get Current Event
            getCurrentEventImplementation: function () { this.getCurrentEventCallback({ Name: '' }); },
            getCurrentEventAsync: function (callback) {
                this.getCurrentEventCallback = callback;
                this.getCurrentEventImplementation();
            },

            /// Get OAuth Encoded API Call Implementation
            getSignedAPIImplementation: throwNotInitialized,
            getSignedAPIAsync: function (apiFragment, postBody, callback) {
                this.getSignedAPICallback = callback;
                this.getSignedAPIImplementation(apiFragment, postBody);
            },

            /// Set an action button in the native app (if implemented)
            setActionButtonImplementation: throwNotInitialized,
            setActionButtonAsync: function (title, imageReserved, callback) {
                this.setActionButtonCallback = callback;
                this.setActionButtonImplementation(title, imageReserved);
            },

            /// Set the title in the native app (if implemented)
            setTitleImplementation: function (title) { document.title = title; },
            setTitleAsync: function (title) {
                this.setTitleImplementation(title);
            }
        }
    };

    var initCheck = setInterval(function () {
        if (DD.Events.getSignedAPIImplementation === throwNotInitialized) {
            clearInterval(initCheck);
            var cbs = onReadyCallbacks;
            onReadyCallbacks = null;
            for (var i = 0; i < cbs.length; ++i) {
                try {
                    cbs[i]();
                } catch (e) { console.log(e); }
            }
        }
    }, 25);

    window.DD = DD;
})();