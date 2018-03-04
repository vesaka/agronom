var renderException = function(content) {
    try {
    var response = JSON.parse(content),
        html = '<h4>Error: ' + response.message + '<h4><div>';

    } catch(e) {
        return content;
    }
    for (var i in response.trace) {
        var trace = response.trace[i];
        html += '<div>\n\
                <p>File: ' + trace.file + '</p>\n\
                <p>Line: ' + trace.line + '</p>\n\
                <p>Class: ' + trace.class + '</p>\n\
                </div>';
    }
    html += '</div>';
    return html;
    
    
}
