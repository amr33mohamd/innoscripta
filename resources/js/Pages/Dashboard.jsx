import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { SimpleGrid } from "@chakra-ui/react";
import CustomPaginator from "@/Components/CustomPaginator";
import NewsCard from "@/Components/NewsCard";
export default function Dashboard({ auth, articles }) {
    const nextPageRedirect = (page) => {
        window.location.href = "/dashboard?page=" + page;
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />
            <SimpleGrid
                spacing={10}
                p={5}
                bg="#fff"
                m={2}
                borderRadius={3}
                minChildWidth="400px"
            >
                {articles.data.map((article) => (
                    <NewsCard
                        key={article.id}
                        title={article.title}
                        author={article.author}
                        image={article.image}
                    />
                ))}
            </SimpleGrid>
            <CustomPaginator
                pagesQuantity={articles.last_page}
                currentPage={articles.current_page}
                onPageChange={nextPageRedirect}
            />
        </AuthenticatedLayout>
    );
}
