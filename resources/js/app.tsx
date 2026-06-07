import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import { FancyAppRoot } from "@particle-academy/fancy-inertia";
import { FancyDataRoot } from "@particle-academy/fancy-query";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.tsx", { eager: false });
        const page = pages[`./Pages/${name}.tsx`];
        if (!page) {
            throw new Error(`Inertia page not found: ./Pages/${name}.tsx`);
        }
        return (page as () => Promise<{ default: unknown }>)();
    },
    setup({ el, App, props }) {
        createRoot(el).render(
            <FancyAppRoot withScreens={false} withECharts={false}>
                <FancyDataRoot>
                    <App {...props} />
                </FancyDataRoot>
            </FancyAppRoot>,
        );
    },
});
