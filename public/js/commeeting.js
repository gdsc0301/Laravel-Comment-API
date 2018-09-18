/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, exports) {

//ComMeeting API v1.2
//Author: Guilherme dos Santos Carvalho
//Target: BetLabs

//Request the comments in JSON format.


function GetComments() {
  $.ajax({
    method: 'get',
    url: '/comments',
    data: {
      //Laravel CSRF token for authorization.
      _token: '{!! csrf_token() !!}'
    },
    success: function success(obj) {
      return obj;
    },
    error: function error(err) {
      return err;
    }
  });
}

//Send the text via AJAX to create a new Comment.
function SendComment(comment_text) {
  //Array with the comment text;
  var objectComment = {
    commentText: comment_text
  };

  $.ajax({
    //Laravel CSRF token for authorization.
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'post',
    url: '/comments/add',
    data: objectComment,
    dataType: 'json',
    success: function success(obj) {
      //Returns the sent comment.
      //Or false in case of non authorization.
      location.reload();
      return obj;
    },
    error: function error(err) {
      return err;
    }
  });
}

//Send the text via AJAX via 'put' data, and the 'id' through the url.
function UpdateComment(commentID, comment_text) {
  var updateData = { text: comment_text };

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'put',
    url: '/comment/id=' + commentID,
    data: updateData,
    success: function success(obj) {
      location.reload();
      return obj;
    },
    error: function error(err) {
      return err;
    }
  });
}

//Send the id through 'post' data, for being deleted.
function DeleteComment(commentID) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'post',
    url: '/comment/delete',
    data: { comment_id: commentID },
    success: function success(obj) {
      location.reload();
      return obj;
    },
    error: function error(err) {
      return err;
    }
  });
}

//
//
//PERSONAL PAGE EVENTS
$('#post-submit').click(function () {
  var text = $('#post-textarea').val();
  SendComment(text);
  $('#post-textarea').val('');
});

$('input.comment-update').click(function () {
  var id = $(this).parent().attr('id');
  var text = $(this).prev().val();

  $(this).parent().toggleClass('hidden');
  UpdateComment(id, text);
});

$('.edit.button').click(function () {
  var id = $(this).attr('id');
  $('#' + id + '.comment-update').toggleClass('hidden');
});

$('.delete.button').click(function () {
  var id = $(this).attr('id');
  DeleteComment(id);
});

/***/ })

/******/ });