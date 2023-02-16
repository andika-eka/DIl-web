import { ref, onBeforeUnmount } from "vue";

export const useCountDown = async (end_time, estimated_time) => {
    const time = ref({
        s: null,
        m: null,
        h: null,
        d: null,
    });
    const endTime = ref(new Date(end_time));
    endTime.value.setHours(endTime.value.getHours() + estimated_time);
    const distance = ref();
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;

    const updateCurrentTime = () => {
        distance.value = endTime.value - new Date().getTime();
        if (distance.value < 0) {
            clearInterval(updateTimeInterval);
        }
        var days = Math.floor(distance.value / _day);
        var hours = Math.floor((distance.value % _day) / _hour);
        var minutes = Math.floor((distance.value % _hour) / _minute);
        var seconds = Math.floor((distance.value % _minute) / _second);
        console.log(days, hours, minutes, seconds);
    };

    const updateTimeInterval = setInterval(updateCurrentTime, 1000);

    onBeforeUnmount(() => {
        clearInterval(updateTimeInterval);
    });

    return {
        time,
    };
};
