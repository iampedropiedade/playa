export class Download {

    download(url, filename) {
        const href = URL.createObjectURL(new Blob([url]))
        const link = document.createElement('a')
        link.href = href;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(href);
    }

}
