import Layout from "../Layout";
import CommunityEngagement from "../Components/CommunityEngagement";
import FancyUiSpotlight from "../Components/FancyUiSpotlight";
import HeroUnit from "../Components/HeroUnit";
import KeyFeatures from "../Components/KeyFeatures";
import MissionStatement from "../Components/MissionStatement";
import ProgramOverview from "../Components/ProgramOverview";
import SuccessStories from "../Components/SuccessStories";
import WaitingList from "../Components/WaitingList";

export default function Home() {
    return (
        <Layout>
            <div className="min-h-screen bg-zinc-50">
                <div className="container mx-auto px-4 py-10 space-y-20 max-w-7xl">
                    <HeroUnit />
                    <FancyUiSpotlight />
                    <MissionStatement />
                    <ProgramOverview />
                    <div id="waiting-list">
                        <WaitingList />
                    </div>
                    <KeyFeatures />
                    <SuccessStories />
                    <CommunityEngagement />
                </div>
            </div>
        </Layout>
    );
}
