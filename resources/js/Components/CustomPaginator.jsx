import React from 'react';
import { ChakraProvider } from '@chakra-ui/react';
import {
    Paginator,
    Container,
    Previous,
    Next,
    PageGroup,
    usePaginator,
} from "chakra-paginator";
export default function CustomPaginator(props) {
    return (
        <ChakraProvider>
        <Paginator
            pagesQuantity={props.pagesQuantity}
            currentPage={props.currentPage}
            onPageChange={props.onPageChange}
        >
            <Container
                align="center"
                justify="space-between"
                w="full"
                p={4}
                bg="#fff"
                m={2}
            >
                <Previous>
                    Previous
                </Previous>
                <PageGroup isInline align="center" />
                <Next>
                    Next
                </Next>
            </Container>
        </Paginator>
    </ChakraProvider>
    );
}