import { createWebHistory, createRouter } from "vue-router";
import Playlist from "../views/Playlist/Main.vue";
import PlaylistCreate from "../views/Playlist/Create.vue";
import About from "../views/About/Main.vue";
import Home from "../views/Home/Main.vue";
import Search from "../views/Search/Main.vue";
import LikedSongs from "../views/LikedSongs/Main.vue";
import YourLibrary from "../views/YourLibrary/Main.vue";
import Recommendations from "../views/Recommendations/Main.vue";
import Album from "../views/Album/Main.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/search",
        name: "Search",
        component: Search,
    },
    {
        path: "/your-library",
        name: "YourLibrary",
        component: YourLibrary,
    },
    {
        path: "/liked-songs",
        name: "LikedSongs",
        component: LikedSongs,
    },
    {
        path: "/recommendations/track/:id",
        name: "Recommendations",
        component: Recommendations,
    },
    {
        path: "/album/:id",
        name: "Album",
        component: Album,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/playlist/create",
        name: "PlaylistCreate",
        component: PlaylistCreate,
    },
    {
        path: "/playlist/:id",
        name: "Playlist",
        component: Playlist,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;