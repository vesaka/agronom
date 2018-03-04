/* global Element */

(function (scope) {
    scope.regex = {
        rule: /^(.+?)\[(.+)\]$/,
        numeric: /^[0-9]+$/,
        integer: /^\-?[0-9]+$/,
        decimal: /^\-?[0-9]*\.?[0-9]+$/,
        email: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
        alpha: /^[a-z]*$/i,
        alphaNumeric: /^[a-z0-9]*$/i,
        alphaDash: /^[a-z0-9_\-\s]*$/i,
        alphaCyrilic: /^[a-zа-я0-9\s]*$/i,
        alphaDashCyrilic: /^[a-zа-я0-9_\-\s]*$/iu,
        text: /^.['-]*$/iu,
        natural: /^[0-9]+$/i,
        naturalNoZero: /^[1-9][0-9]*$/i,
        phone: /^[\+]?[(]?[0-9]{3}[)]?[-\s]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im,
        ip: /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,
        base64: /[^a-zA-Z0-9\/\+=]/i,
        numericDash: /^[\d\-\s]+$/,
        greek: /^[a-zA-Z0-9Ά-ωΑ-ώ\s]+$/i,
        url: /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,
        date: /(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/
    };

    scope.form;
    scope.errorBlock;
    scope.options = {
        beforeSubmit: function () {
            return;
        },
        submitHandler: function() {
            submit();
        },
        errorPlacement: function (el, msg) {
            errorPlacement(el, msg);
        },
        errorPlacements: {},
        onSuccess: function () {},
        onError: function () {},
        debug: true,
        runtime: true,
        displayAll: true,
        displayErrors: 'single',
        classError: 'error',
        errorId: 'message-error',
        async: true,
        ajaxSubmit: null,
        normalSubmit: function () {},
        clearErrors: function() {
            clearErrors();
        }
    };

    scope.rules = {};
    scope.norms = {};
    scope.errors = {};

    scope.validate = function () {
        scope.errors = {};
        scope.options.clearErrors();
        for (var name in rules) {
            var _rules = rules[name],
                _el = scope.form.elements[name],
                _value,
                valid;
            for (var i = 0; i < _rules.length; i++) {
                if (_rules[i].length !== 2)
                    continue;
                var rule_args = _rules[i][0];

                if (typeof rule_args === 'string') {
                    rule_arg = rule_args.split(':');
                    if (typeof this[rule_arg[0]] !== 'function') {
                        log('Method ' + rule_arg[0] + ' does not exists');
                        continue;
                    }
                    
                    _value = _el.type === 'file' ? _el : _el.value;
                    valid = this[rule_arg[0]](_value, rule_arg[1] || null);
                } else if (typeof rule_args === 'function') {
                    valid = rule_args();
                }

                if (!valid) {
                    
                    var input = scope.form.elements[name];
                    if (scope.options.runtime) {
                        if(input.length > 1) {
                            var inputName = input[0].name;
                        } else {
                            var inputName = input.name;
                        }
                        
                        if (typeof scope.options.errorPlacements[inputName] !== 'function') {
                            var id = 'error_' + inputName;
                            if (!document.getElementById(id)) {
                                var parent = document.createElement('div');
                                parent.id = id;
                                parent.className = scope.options.classError;
                                insertAfter(parent, input);
                            }
                            scope.options.errorPlacement(input, _rules[i][1].format(rule_arg[1] || null));
                        } else {
                            scope.options.errorPlacements[inputName](input, _rules[i][1].format(rule_arg[1] || null));
                        }
                    }
                    if (typeof scope.errors[name] === 'undefined') {
                        scope.errors[name] = new Array();
                    }
                    scope.errors[name].push(_rules[i][1]);

                    if (scope.options.displayErrors === 'single') {
                        break;
                    }
                }
            }
            if (!scope.options.displayAll) {
                break;
            }
        }
        return Object.keys(scope.errors).length === 0;
    };
    
    var submit = function() {
        scope.form.submit();
    };

    var errorPlacement = function (el, msg) {
        var classError = el.name + '_' + scope.options.classError,
            parent = document.getElementById('error_' + el.name),
            error = document.getElementsByClassName(classError);
        if (el.className.indexOf('text-warning') === -1) {
            el.className += ' text-warning';
        }

        while(error.length > 0) {
            error[0].remove();
         }
        
        error = document.createElement('p');
        error.className = classError;
        error.innerHTML = msg;

        parent.appendChild(error);
    };

    var clearErrors = function () {
        scope.errors = {};
        var errors = document.getElementsByClassName(scope.options.classError);

        while (errors.length > 0) {
            
            var input = errors[0].previousElementSibling;
            input.classList.remove('text-warning');
            errors[0].remove();
        }
    };

    var insertAfter = function (el, referenceNode) {
        var block;
        if (referenceNode.length > 1) {
            block = referenceNode[0];
        } else {
            block = referenceNode;
        }
        block.parentNode.insertBefore(el, block.nextSibling);
    };

    this.required = function (a) {
        return a.length > 0;
    };

    this.equals = function (a, b) {
        return a === b;
    };

    this.different = function (a, b) {
        return a !== b;
    };

    this.minLength = function (a, b) {
        return a.length >= b;
    };

    this.maxLength = function (a, b) {
        return a.length <= b;
    };

    this.length = function (a, b) {
        return a.length === b;
    };

    this.min = function (a, b) {
        return a >= b;
    };

    this.max = function (a, b) {
        return a <= b;
    };

    this.range = function (a, b) {
        var _b = b.split('-');
        return a >= parseInt(_b[0]) && a <= parseInt(_b[1]);
    };
    
    this.between = function(a,b) {
        var _b = b.split('-');
        return a.length >= _b[0] && a.length <= _b[1];
    };
    
    this.same = function(a,b) {
        for (var index in scope.form.elements) {
            if (scope.form.elements[index].name === b) {
                return scope.form.elements[index].value === a;
            }
        }
        return true;
    };
    
    this.notSame = function(a,b) {
        for (var index in scope.form.elements) {
            if (scope.form.elements[index].name === a) {
                return scope.form.elements[index].value !== b;
            }
        }
        return true;
    };

    this.gt = function (a, b) {
        return a > b;
    };

    this.lt = function (a, b) {
        return a < b;
    };
    
    this.age = function (a, b) {
        return true;
    }

    this.regexp = function (a, b) {
        var pattern = new RegExp(scope.regex[b]);
        return pattern.test(a);
    };

    this.hasExtension = function (a, b) {
        if (a.type !== 'file') return true;

        var array = b.replace("\s*", "").trim().split(','),
            name = a.files[0].name,
            extension = name.substr(name.lastIndexOf('.') + 1).trim();
        return array.indexOf(extension) > -1;
    };
    
    this.list = function (a, b) {
        var array = b.replace("\s*", "").trim().split(',');
        return array.indexOf(a) > -1;
    };
    
    this.fileRequired = function(a, b) {
        console.log(a, a.files[0] !== 'undefined');
        if(a.type !== 'file') return true;
        return typeof a.files[0] !== 'undefined';
    };
    
    this.fileMaxSize = function(a, b) {
        if(a.type !== 'file') return true;
        console.log(a);
        return a.files[0].size <= parseInt(b);
    };

    this.json = function (text) {
        try {
            var o = JSON.parse(text);
            if (o && typeof o === "object" && o !== null) {
                true;
            }
        } catch (e) {
            return false;
        }
    };

    var extend = function (options) {
        var _options = scope.options;
        for (var prop in _options) {
            if (options.hasOwnProperty(prop)) {
                _options[prop] = options[prop];
            }
        }
        return _options;
    };

    Element.prototype.validator = function (rules, options) {
        
        extend(options || {});
        if (typeof rules !== 'object') {
            log('There are no declared validation rules');
            return;
        }

        if (this.tagName !== "FORM") {
            log("Selected element is not a form!");
            return;
        }
        var inputs = this.elements;
        var names = [];
        for (var index in inputs) {
            if (typeof inputs[index].name === 'string' && inputs[index].name.length > 0) {
                names.push(inputs[index].name);
            }
        }

        for (var name in rules) {
            if (names.indexOf(name) === -1) {
                log('Field ' + name + ' does not exists');
                delete rules[name];
            }
        }

        scope.rules = rules;
        scope.form = this;

        this.addEventListener("submit", function (ev) {

            scope.options.beforeSubmit(ev);

            if (!validate()) {
                ev.preventDefault();
                return false;
            }
            
            if (typeof scope.options.submitHandler === 'function') {
                scope.options.submitHandler(ev);
            }
        });
        if (scope.options.displayErrors === "single") {
            if (null === document.getElementById(scope.options.errorId)) {
                scope.errorBlock = document.createElement('div');
                scope.errorBlock.id = scope.options.errorId;
                scope.form.parentNode.insertBefore(scope.errorBlock, scope.form);
            } else {
                scope.errorBlock = document.getElementById(scope.options.errorId);
            }
        }
        return this;
    };

    Element.prototype.sanitizer = function (norms) {
        return this;
    };

    Element.prototype.setRule = function (name, rules) {
        if (typeof scope.rules[name] !== "undefined") {
            scope.rules[name] = rules;
        }
    };

    this.settings = function (options) {
        scope.options.extend(options || {});
    };

    if (!String.prototype.format) {
        String.prototype.format = function () {
            var args = arguments;
            return this.replace(/{(\d+)}/g, function (match, number) {
                return typeof args[number] !== 'undefined' ? args[number] : match;
            });
        };
    }

    this.addRule = function (name, method) {
        if (typeof this[name] !== "undefined") {
            this[name] = method;
        } else {
            console.log('Method ' + name + ' already exists!');
        }
        return this;
    };

    this.setRules = function (name, rules) {
        if (typeof scope.rules[name] !== "undefined") {
            scope.rules[name] = rules;
        }
    };

    this.addExpression = function (name, pattern) {
        if (typeof scope.regex[name] !== "undefined") {
            scope.regex[name] = pattern;
        } else {
            console.log('A regular expresion with name' + name + 'already exists');
        }
    };

    var log = function () {
        if (!scope.options.debug)
            return;
        for (var i = 0; i < arguments.length; i++) {
            console.log(arguments[i]);
        }
    };

})(typeof window !== 'undefined' ? window : this);

Object.size = function () {
    var size = 0, key;
    for (key in this) {
        if (this.hasOwnProperty(key))
            size++;
    }
    return size;
};
