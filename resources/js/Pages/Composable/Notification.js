import { useNotification } from "@kyvg/vue3-notification";

const { notify }  = useNotification()

export function useNotifyUser(res = null, success = true, warn = true, error = true) {
    if (res.code === 200) {
        if (Boolean(res.status)) {
            if (success) {
                let message = res.message ?? 'Success';
                notify({
                    group: 'public',
                    type: 'success',
                    text: message,
                    duration: 4000
                })
            }
        } else {
            if (warn) {
                let message = res.message ?? 'Warning';
                notify({
                    group: 'public',
                    type: 'warn',
                    text: message,
                    duration: 6000
                })
            }
        }
    } else {
        if (error) {
            let message = res.message ?? 'Error';
            notify({
                group: 'public',
                type: 'error',
                text: message,
                duration: 8000
            })
        }
    }
}
