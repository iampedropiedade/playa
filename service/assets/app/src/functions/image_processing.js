import ColorThief from "colorthief";

export class ImageProcessing {

    googleProxyURL = 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&refresh=2592000&url='

    async setDominantColour(imageUrl) {
        const colorThief = new ColorThief()
        if(imageUrl === undefined) {
            return
        }
        const img = new Image();
        img.addEventListener('load', () => {
            let dominantColour = colorThief.getColor(img)
            return 'background-image: linear-gradient(to bottom, rgba(' + dominantColour[0] + ', ' + dominantColour[1] + ', ' + dominantColour[2] + ', 1), transparent 20%)'
        });
        img.crossOrigin = 'Anonymous'
        img.src = this.googleProxyURL + encodeURIComponent(imageUrl)
    }

}
