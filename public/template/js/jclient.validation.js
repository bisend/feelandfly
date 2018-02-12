// JClientValidation library created by Mukola Shabarovskiy in 2014.
// This library was created for inputs validation

// Regular expressions for validated inputs
// You can to add new item and use it in parameters
var RegularExpressions = {
	NAME: /^[а-яА-ЯёЁіІїЇa-zA-Z]{2,30}$/,                                             // For example "Nicholas" (one word)
	FULL_NAME: /^[а-яА-ЯёЁіІїЇa-zA-Z'`\s,.-]{2,100}$/,                                  // For example "Nicholas Brick" (two words)
	PASSWORD: /^\S{6,20}$/,															// For example word.pass123123 (difficult password)
	SIMPLE_PASSWORD: /^[\w.]{6,20}$/,                                               // For example 123123 (similar password)
	EMAIL: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,	 // For example nicholas.brick@mail.com
	PHONE_NUMBER: /^[0-9\-\(\)\+ ]{5,30}$/,											// For example +38(012) 345-67-89
	URL_LINK: /^http:+|https:+.+$/,                                                 // For example http://fs.to
	LETTERS_ONLY: /^[а-яА-ЯёЁіІїЇa-zA-Z]+$/,                                          // Letters only
	SIMPLE_TEXT: /.{2,}\s*/,                                                        // Just simple text (more than two symbols)
	MIN_TEXT: /.{1,}\s*/,                                                           // Just simple text (more than one symbol)
	FILE_PATH: /^[а-яА-ЯёЁіІїЇa-zA-Z]{2,200}$/,                                       // For example drive:\dir\dir\file.ext
	DATE_TIME_R: /^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/,         // For example 2016-04-13 09:41:46
	DATE_RANGE: /^([0-9]{2}\/[0-9]{2}\/[0-9]{4})|([0-9]{2}\/[0-9]{2}\/[0-9]{4} \- [0-9]{2}\/[0-9]{2}\/[0-9]{4})$/, // For example 04/25/2016 or 04/25/2016 - 05/26/2017
	OKPO_CODE: /.{2,}\s*/,                                                          // OKPO code
	POSITIVE_DIGITS: /^[1-9][0-9]*$/,												// Digits greater than 0.
	DIGITS_ONLY: /^[0-9]{1,20}$/                                                    // For digits only
};

// options = {
//      expression : RegExp,                                // Regular expression for validation
//      ChangeOnValid : func(input),                        // Performs when state has been changed on valid
//      ChangeOnInvalid : func(input),                      // Performs when state has been changed on invalid
//      showErrors : boolean,                               // Show errors in placeholder 
//      requiredErrorMessage : string,
//      regExErrorMessage : string,
//      required : boolean                                  // If an input is required
//      autoValidating : boolean                            // Validation on focus out ( blur )
//}
function RegExValidatingInput(input, options) {
	// The context of this object
	var context = this;

	// Input for validation
	this.input = input;

	// Settings object
	this.options = options;

	// Input validation state
	this.isValid = true;

	// Value in memory (for place holder validation)
	this.memoryValue = undefined;

	// Initial placeholder for restore
	this.initialPlaceHolder = undefined;

	// Initial input value for restore
	this.initialValue = this.input.val();

	// Constructor function (initialize object)
	this.Init = function () {
		// Sets default values if they are not set
		context.CheckOptions();

		// FocusOut handler
		context.input.focusout(function () {
			if (context.GetValue().length > 0 && context.options.autoValidating) {
				context.Validate();
			}
		});

		// KeyUp handler
		context.input.on('keyup', function () {
			if (context.GetValue().length == 0) {
				context.input.attr("placeholder", context.initialPlaceHolder);
				if (context.options.ChangeOnValid != undefined) {
					context.options.ChangeOnValid(context.input);
				}
			}
			context.memoryValue = context.input.val();
		});

		// FocusIn handler
		context.input.focusin(function () {
			if (context.options.showErrors == true) {
				if (context.memoryValue != undefined) {
					if (context.memoryValue != undefined) {
						context.input.val(context.memoryValue);
					}
				}
			}
			if (context.options.ChangeOnValid != undefined) {
				context.options.ChangeOnValid(context.input);
			}
			context.input.attr("placeholder", context.initialPlaceHolder);
		});

		// Sets initial placeholder
		context.initialPlaceHolder = context.input.attr("placeholder");
		context.initialPlaceHolder = (context.initialPlaceHolder != undefined ? context.initialPlaceHolder : "");
	};

	// General validation function
	this.Validate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.IsValueCorrect(value, context.options.expression)) {
				context.SetValidState();
			} else {
				context.SetInvalidState();
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.SetValidState();
				} else {
					context.SetInvalidState();
				}
			} else {
				context.SetValidState();
			}
		}
	};

	// Idle validation function ( without callbacks )
	this.IdleValidate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.IsValueCorrect(value, context.options.expression)) {
				context.isValid = true;
			} else {
				context.isValid = false;
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.isValid = true;
				} else {
					context.isValid = false;
				}
			} else {
				context.isValid = true;
			}
		}
	};

	// Sets valid state of input
	this.SetValidState = function () {
		// Sets valid state
		context.isValid = true;
		// Clears memory value
		context.memoryValue = undefined;
		// Performs handler for valid state
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets invalid state of input
	this.SetInvalidState = function () {
		// Sets invalid state
		context.isValid = false;

		// If placeholder mode enabled, we add the message
		if (context.options.showErrors == true) {
			// Sets value to memory
			if (context.memoryValue == undefined) {
				context.memoryValue = context.input.val();
			}

			if (context.input.val() == "" && !context.HasMemorized()) {
				context.input.attr("placeholder", context.options.requiredErrorMessage);
			} else {
				context.input.attr("placeholder", context.options.regExErrorMessage);
			}
			context.SetValue("");
		}

		// Performs handler for invalid state
		if (context.options.ChangeOnInvalid != undefined) {
			context.options.ChangeOnInvalid(context.input);
		}
	};

	// Gets value from input
	this.GetValue = function () {
		return context.input.val();
	};

	// Sets value in input
	this.SetValue = function (value) {
		context.input.val(value);
	};

	// Returns validation state
	this.IsValid = function () {
		return context.isValid;
	};

	// Validate value by regular expression
	this.IsValueCorrect = function (value, regExp) {
		if (value.search(regExp) !== -1) {
			return true;
		}
		return false;
	};

	// Checks options and sets default
	this.CheckOptions = function () {
		if (context.options.expression == undefined) {
			context.options.expression = RegularExpressions.LETTERS_ONLY;
		}
		if (context.options.isValidateInRealTime == undefined) {
			context.options.isValidateInRealTime = false;
		}
		if (context.options.showErrors == undefined) {
			context.options.showErrors = false;
		}
		if (context.options.requiredErrorMessage == undefined) {
			context.options.requiredErrorMessage = "Required field";
		}
		if (context.options.regExErrorMessage == undefined) {
			context.options.regExErrorMessage = "Incorrect data";
		}
		if (context.options.required == undefined) {
			context.options.required = true;
		}
		if (context.options.autoValidating == undefined) {
			context.options.autoValidating = true;
		}
	};

	// Checks memorized value
	this.HasMemorized = function () {
		return (context.memoryValue !== undefined && context.memoryValue !== "");
	};

	// Sets input state to default
	this.ResetToDefault = function () {
		context.input.attr("placeholder", context.initialPlaceHolder);
		context.input.val(context.initialValue);
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Performs method of initialization
	this.Init();
}

// options = {
//      compareValue : string,                              // The value for compare
//      ChangeOnValid : func(input),                        // Performs when state has been changed on valid
//      ChangeOnInvalid : func(input),                      // Performs when state has been changed on invalid
//      showErrors : boolean,                               // Show errors in placeholder 
//      requiredErrorMessage : string,
//      errorMessage : string,
//      required : boolean                                  // If an input is required
//      autoValidating : boolean                            // Validation on focus out or blur
//}
function EqualValidatingInput(input, options) {
	// The context of this object
	var context = this;

	// Input for validation
	this.input = input;

	// Settings object
	this.options = options;

	// Input validation state
	this.isValid = false;

	// Value in memory (for place holder validation)
	this.memoryValue = undefined;

	// Initial placeholder for restore
	this.initialPlaceHolder = undefined;

	// Initial input value for restore
	this.initialValue = this.input.val();

	// Constructor function (initialize object)
	this.Init = function () {
		// Sets default values if they are not set
		context.CheckOptions();

		// FocusOut handler
		context.input.focusout(function () {
			if (context.GetValue().length > 0 && context.options.autoValidating) {
				context.Validate();
			}
		});

		// KeyUp handler
		context.input.on('keyup', function () {
			if (context.GetValue().length == 0) {
				context.ResetToDefault();
			}
			context.memoryValue = context.input.val();
		});

		// FocusIn handler
		context.input.focusin(function () {
			if (context.options.showErrors == true) {
				if (context.memoryValue != undefined) {
					if (context.memoryValue != undefined) {
						context.input.val(context.memoryValue);
					}
				}
			}
			if (context.options.ChangeOnValid != undefined) {
				context.options.ChangeOnValid(context.input);
			}
			context.input.attr("placeholder", context.initialPlaceHolder);
		});

		// Sets initial placeholder
		context.initialPlaceHolder = context.input.attr("placeholder");
	};

	// General validation function
	this.Validate = function () {
		// Gets value of input
		var value = context.input.val();

		if (context.options.required) {
			if (context.options.compareValue == value) {
				context.SetValidState();
			} else {
				context.SetInvalidState();
			}
		} else {
			if (value != "") {
				if (context.IsValueCorrect(value, context.options.expression)) {
					context.SetValidState();
				} else {
					context.SetInvalidState();
				}
			} else {
				context.SetValidState();
			}
		}
	};

	// Sets valid state of input
	this.SetValidState = function () {
		// Sets valid state
		context.isValid = true;
		// Clears memory value
		context.memoryValue = undefined;
		// Performs handler for valid state
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets invalid state of input
	this.SetInvalidState = function () {
		// Sets invalid state
		context.isValid = false;

		// If placeholder mode enabled, we add the message
		if (context.options.showErrors == true) {
			// Sets value to memory
			if (context.memoryValue == undefined) {
				context.memoryValue = context.input.val();
			}

			if (context.input.val() == "" && !context.HasMemorized()) {
				context.input.attr("placeholder", context.options.requiredErrorMessage);
			} else {
				context.input.attr("placeholder", context.options.errorMessage);
			}
			context.SetValue("");
		}

		// Performs handler for invalid state
		if (context.options.ChangeOnInvalid != undefined) {
			context.options.ChangeOnInvalid(context.input);
		}
	};

	// Gets value from input
	this.GetValue = function () {
		return context.input.val();
	};

	// Sets value in input
	this.SetValue = function (value) {
		context.input.val(value);
	};

	// Returns validation state
	this.IsValid = function () {
		return context.isValid;
	};

	// Checks options and sets default
	this.CheckOptions = function () {
		if (context.options.showErrors == undefined) {
			context.options.showErrors = false;
		}
		if (context.options.requiredErrorMessage == undefined) {
			context.options.requiredErrorMessage = "Required field";
		}
		if (context.options.errorMessage == undefined) {
			context.options.errorMessage = "Data not equal";
		}
		if (context.options.required == undefined) {
			context.options.required = true;
		}
		if (context.options.autoValidating == undefined) {
			context.options.autoValidating = true;
		}
	};

	// Checks memorized value
	this.HasMemorized = function () {
		return (context.memoryValue == undefined || context.memoryValue == "");
	};

	// Sets input state to default
	this.ResetToDefault = function () {
		context.input.attr("placeholder", context.initialPlaceHolder);
		context.input.val(context.initialValue);
		if (context.options.ChangeOnValid != undefined) {
			context.options.ChangeOnValid(context.input);
		}
	};

	// Sets compare value
	this.SetCompareValue = function (value) {
		context.options.compareValue = value;
	};

	// Performs method of initialization
	this.Init();
}
