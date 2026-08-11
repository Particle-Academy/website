import { createInertiaApp } from "@inertiajs/react";
import createServer from "@inertiajs/react/server";
import type { ComponentType } from "react";
import { FancyAppRoot } from "@particle-academy/fancy-inertia";
import { FancyDataRoot } from "@particle-academy/fancy-query";
import ReactDOMServer from "react-dom/server";

/**
 * Inertia defaults every project to port 13714, so several Laravel apps on one
 * machine silently fight over it — the first to bind wins and the rest either
 * fail to start or, worse, get render requests answered by a DIFFERENT app's
 * SSR server. This app therefore takes its own port; keep INERTIA_SSR_URL in
 * `.env` pointed at the same one.
 */
const ssrPort = Number(process.env.INERTIA_SSR_PORT ?? 13715);

createServer(
    (page) =>
        createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./Pages/**/*.tsx", { eager: true });
            const page = pages[`./Pages/${name}.tsx`];
            if (!page) {
                throw new Error(`Inertia page not found: ./Pages/${name}.tsx`);
            }
            return page as { default: ComponentType<any> };
        },
        setup: ({ App, props }) => (
            <FancyAppRoot withScreens={false} withECharts={false}>
                <FancyDataRoot>
                    <App {...props} />
                </FancyDataRoot>
            </FancyAppRoot>
        ),
    }),
    { port: ssrPort },
);
