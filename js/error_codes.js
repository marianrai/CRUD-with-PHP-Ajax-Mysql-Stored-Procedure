
const HTML_ERROR_START = "<div class='well'>";
const HTML_ERROR_END = "</div>";
const HTML_ERROR_400 = HTML_ERROR_START + "400 error: Bad request. The request had bad syntax or was inherently impossible to be satisfied." + HTML_ERROR_END;
const HTML_ERROR_401 = HTML_ERROR_START + "401 error: Unauthorized request." + HTML_ERROR_END;
const HTML_ERROR_403 = HTML_ERROR_START + "403 error: The request is for something forbidden." + HTML_ERROR_END;
const HTML_ERROR_404 = HTML_ERROR_START + "404 error: The processing file couldn't be found on the server." + HTML_ERROR_END;
const HTML_ERROR_500 = HTML_ERROR_START + "500 error: Internal server error." + HTML_ERROR_END;
const HTML_ERROR_501 = HTML_ERROR_START + "501 error: Not implemented. The server does not support the facility required." + HTML_ERROR_END;
