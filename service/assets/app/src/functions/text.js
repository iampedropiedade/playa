export class Text {

    trim(text, maxLength, ellipsis=true) {
        if(text.length <= maxLength) {
            return text
        }
        let trimmed = text.substring(0, maxLength)
        trimmed = trimmed.substring(0, Math.min(trimmed.length, trimmed.lastIndexOf(' ')))
        if(text.length > trimmed.length && ellipsis === true) {
            trimmed += '...';
        }
        return trimmed;
    }

}
