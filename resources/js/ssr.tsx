import { createInertiaApp } from "@inertiajs/react";
import createServer from "@inertiajs/react/server";
import { FancyAppRoot } from "@particle-academy/fancy-inertia";
import { FancyDataRoot } from "@particle-academy/fancy-query";
import ReactDOMServer from "react-dom/server";

createServer((page) =>
    createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./Pages/**/*.tsx", { eager: true });
            const page = pages[`./Pages/${name}.tsx`];
            if (!page) {
                throw new Error(`Inertia page not found: ./Pages/${name}.tsx`);
            }
            return page as { default: unknown };
        },
        setup: ({ App, props }) => (
            <FancyAppRoot withScreens={false} withECharts={false}>
                <FancyDataRoot>
                    <App {...props} />
                </FancyDataRoot>
            </FancyAppRoot>
        ),
    })
);
