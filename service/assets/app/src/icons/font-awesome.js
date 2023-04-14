import {library} from '@fortawesome/fontawesome-svg-core'
import {
    faClock, faUser, faHeart as faHearRegular,
    faQuestionCircle,
} from "@fortawesome/free-regular-svg-icons";
import {
    faBackwardStep,
    faBars,
    faCalendarDays,
    faCircle, faCircleChevronLeft, faCircleChevronRight,
    faCircleNotch,
    faCirclePause,
    faCirclePlay,
    faDesktop, faEllipsisVertical,
    faForwardStep,
    faHeadphonesSimple, faHeart, faHouse, faLaptop,
    faLayerGroup, faMagnifyingGlass, faRepeat,
    faShuffle, faSquarePlus,
    faTv, faVolumeHigh, faVolumeLow, faVolumeOff,
    faXmark
} from '@fortawesome/free-solid-svg-icons'

library.add(
    faBars, faCircleNotch, faClock, faCircle,
    faCirclePlay, faCirclePause, faBackwardStep, faForwardStep,
    faRepeat, faShuffle, faQuestionCircle,
    faVolumeLow, faVolumeHigh, faVolumeOff,
    faCalendarDays, faTv, faUser, faHearRegular,
    faDesktop, faHeadphonesSimple, faLaptop, faHouse,
    faMagnifyingGlass, faLayerGroup, faSquarePlus, faHeart,
    faCircleChevronLeft, faCircleChevronRight, faEllipsisVertical, faXmark
)