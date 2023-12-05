import React from "react";
import {
    Card,
    CardBody,
    CardFooter,
    Stack,
    Button,
    Text,
    Heading,
    Image,
} from "@chakra-ui/react";
export default function NewsCard(props) {
    return (
        <Card
            direction={{ base: "column", sm: "row" }}
            overflow="hidden"
            variant="outline"
        >
            <Image
                objectFit="cover"
                maxW={{ base: "100%", sm: "200px" }}
                src={props.image}
                alt={props.title}
            />

            <Stack>
                <CardBody>
                    <Heading size="md">{props.title}</Heading>

                    <Text py="2">{props.author}</Text>
                </CardBody>

                <CardFooter>
                    <Button variant="solid" colorScheme="blue">
                        Read More ...
                    </Button>
                </CardFooter>
            </Stack>
        </Card>
    );
}
